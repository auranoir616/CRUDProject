<?php

namespace App\Http\Controllers;

use Share;
use App\Models\Post;
use App\Models\User;
use App\Models\Likes;
use App\Models\Follow;
use App\Models\Messages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\PostController;

class DataController extends Controller

{
    //untuk pagination halaman
    public function footerData(){
        $alldata = DB::table('allpost')->whereNotNull('title')->orderBy('updated_at', 'desc')->paginate(5);
        return view('_footer',compact('alldata'));

    }
    //menampilkan data user yang terdaftar
    public function profileData($id, $username){
        if(auth()->check()){
        $userData = DB::table('users')->where('id', $id)->get();
        $postdata = DB::table('allpost')->where('user_id', $id)->paginate(5);
        $postIDs = $postdata->pluck('id');
        $likes = Likes::whereIn('post_id', $postIDs)->get();
        $likesCount = $likes->groupBy('post_id')->map->count();
        $comments = DB::table('userscomments')->orderBy('updated_at')->get();
        $postCount = DB::table('post')->where('user_id',$id)->count('id');
        $followingCount = DB::table('follower')->where('user_id',$id)->count('following_user');
        $followingCount = $followingCount - 1 ;
        $followerCount = DB::table('follower')->where('following_user',$id)->count('following_user');
        $followerCount = $followerCount - 1;
           
        $postController = app('App\Http\Controllers\PostController');
        $sharepage = $postController->SharePage();
        $postToShare = Post::select('id')->get();
        // dd($postdata);
        foreach($postToShare as $data){
            $sharepage = $postController->SharePage($data);
           //  dd($data);
           }

           foreach($postdata as $data) {
               $formatTime = $postController->formatTimeAgo($data->updated_at);
             $data->formatted_updated_at = $postController->formatTimeAgo($data->updated_at);
        }
        // dd($userData, $postdata, $postCount, $followingCount, $followerCount);

        return view('profileusers', compact('postdata','likesCount','comments','sharepage','followerCount','followingCount','postCount','userData'));
        }else{
        return redirect('loginpage');
    }  

    }

    public function search(Request $request){
        $data = $request->input('query');
        if($data){
        $userID = auth()->user()->id;
        // dd($user);
        $resultsPost = Post::where('body','like',"%$data%")->paginate(10);
        $resultsUser = User::where('username','like',"%$data%")->where('id', '!=', $userID)->paginate(10);
        $comments = DB::table('userscomments')->orderBy('updated_at')->get();

        $postController = app('App\Http\Controllers\PostController');
        $sharepage = $postController->SharePage();
        $postToShare = Post::select('id')->get();
        // dd($postdata);
        foreach($postToShare as $data){
            $sharepage = $postController->SharePage($data);
           //  dd($data);
           }
           foreach($resultsPost as $data) {
            $formatTime = $postController->formatTimeAgo($data->updated_at);
          $data->formatted_updated_at = $postController->formatTimeAgo($data->updated_at);
     }

           foreach($resultsUser as $data) {
               $formatTime = $postController->formatTimeAgo($data->updated_at);
             $data->formatted_updated_at = $postController->formatTimeAgo($data->updated_at);
        }

        return view('searchResults', compact('resultsPost','resultsUser','comments','sharepage'));
        }
        else{
            return view('searchResults');
        }
    }

    public function messagesPage(User $datauser){
        if(auth()->check()){

        $sender = auth()->id();
        $receiver = $datauser->id;
        $receiverName = $datauser->name;
        $chatIds = [$sender, $receiver];
        sort($chatIds);
        
        //sort users
        $result = DB::table('messages')
        ->where('user_id', $sender)
        ->groupBy('recipient_id')
        ->orderByDesc(DB::raw('MAX(created_at)'))
        ->pluck('recipient_id');
        $userdata = DB::table('users')->whereIn('id',$result)->get();
        $resultArray = $result->toArray();
        $userdatasorted = $userdata->sortBy(function ($user) use ($resultArray) {
            return array_search($user->id, $resultArray);
        });
        //mencari data inbox yang belum dibalas
        $idChat = DB::table('messages')->distinct()->pluck('id_chat');
        $inboxData = Messages::where('recipient_id', $sender)
        ->where('read_status', 0)
        ->select('user_id')
        ->groupBy('user_id')
        ->orderByDesc(DB::raw('MAX(created_at)'))
        ->pluck('user_id');
        $userdataInbox = DB::table('users')->whereIn('id',$inboxData)->get();
        $resultArrayInbox = $inboxData->toArray();
        $userdatasortedInbox = $userdataInbox->sortBy(function ($user) use ($resultArrayInbox) {
            return array_search($user->id, $resultArrayInbox);
        });
        
        $inboxMessages = Messages::where('recipient_id', $sender)->where('read_status', 0)->get();
        $inboxCount =  Messages::where('recipient_id', $sender)->where('read_status', 0)->count();

            $messagesSender = DB::table('messages')
                            ->where('id_chat', implode('', $chatIds))
                            ->orderBy('created_at','desc')
                            ->get();
            
         $formatedTimeFunc = app('App\Http\Controllers\PostController');
        foreach($messagesSender as $data) {
            $formatTime = $formatedTimeFunc->formatTimeAgo($data->created_at);
         $data->formatted_updated_at = $formatedTimeFunc->formatTimeAgo($data->created_at);
                         }
        return view('message', compact('sender','result','receiver','messagesSender','userdatasorted','datauser','receiverName','inboxMessages','inboxCount','userdatasorted','userdatasortedInbox'));
    }else{
        return redirect('loginpage');
    }  

    }
    public function readInbox(Messages $messages){
        $user = auth()->user();
        $messages->update(['read_status' => 1]);
        return response()->json(['messages' => $messages]);
    }    
    public function getInbox(){
        $sender = auth()->id();
        $inboxCount =  Messages::where('recipient_id', $sender)->where('read_status', 0)->count();
        return response()->json(['inboxCount' => $inboxCount]);
    }

    public function sendMessages(Messages $msg, Request $request){
        $data = $request->validate([
            'content' => 'required',
        ]);
        $sender = auth()->user();
        $receiver = $request->input('reciever');
        $chatIds = [$sender->id, $receiver];
        sort($chatIds);

        if($data){
            $messages = new Messages;
            $messages->content = $request->input('content'); 
            $messages->recipient_id = $request->input('reciever');
            // Gabungkan id pengirim dan penerima yang sudah diurutkan
            $messages->id_chat = implode('', $chatIds);
            $messages->user_id = auth()->id();
       if($messages->save()){
        return redirect()->back();
        // return view('message', compact('messagesdata','sender','receiver')); 
       }else{
        return redirect()->back()->with('error', 'Anda tidak memiliki izin');
       }
    }else{
        return redirect()->back()->with('error', 'Anda tidak memiliki izin');
    }
    }

    public function listUsers(){
        $user = auth()->id(); //menampilkan data user kecuali yang sedang login
        $allusers = DB::table('users')->whereNotIn('id',[$user])->paginate(10);
        return view('listusers',compact('allusers'));
    }

    public function dataMyProfile(){
        if(auth()->check()){
            $user = auth()->id();
            $postdata = [];
            $userdata = [];
                $userdata = auth()->user()->get();
                $postdata = auth()->user()->usersPosts()->latest()->paginate(3);
                $postIDs = $postdata->pluck('id');
                $likes = Likes::whereIn('post_id', $postIDs)->get();
                $likesCount = $likes->groupBy('post_id')->map->count();
                $comments = DB::table('userscomments')->orderBy('updated_at')->get();
                $postToEdit = Post::where('user_id', $user);
                $postController = app('App\Http\Controllers\PostController');
                $sharepage = $postController->SharePage();
                $postToShare = Post::select('id')->get();
                // dd($postdata);
                foreach($postToShare as $data){
                    $sharepage = $postController->SharePage($data);
                   //  dd($data);
                   }

                   foreach($postdata as $data) {
                       $formatTime = $postController->formatTimeAgo($data->updated_at);
                    $data->formatted_updated_at = $postController->formatTimeAgo($data->updated_at);
                }
        
                          
                return view('profile', compact('postdata','likesCount','comments','sharepage','postToEdit'));
            }else{
                return redirect('/');
        
            }
        
    }
    public function follow(Request $request){
        $user = auth()->user();
        $following = $request->input('following_user_id');
        $followed = Follow::where('user_id', $user->id)
        ->where('following_user', $following)
        ->first();
        if ($followed) {
        // Jika sudah ada like, hapus like tersebut
        $followed->delete();
        } else {
        // Jika belum ada like, tambahkan like baru
        $follow = new Follow;
        $follow->user_id = $user->id;
        $follow->following_user = $following;
        $follow->save();
        }
        return redirect()->back();
    }
    public function likesCount(Post $postId){
        $user = auth()->user();
        $postId = $postId->id;
        $CountLikesPost = Likes::where('post_id', $postId)->count();
        return response()->json(['CountLikesPost' => $CountLikesPost,'postId' => $postId, ]);
    }

    public function editBio(User $datauser, Request $request){
        if(!auth()->check()){
            return redirect('/loginPage');
        }else{
            if(auth()->user()->id == $datauser['id']){
                $data = $request->validate([
                    'editBio'=> 'required',
                ]);
                $newBio = ['bio'=> $request->editBio];

                $datauser->update($newBio);
                 if ($datauser->update($newBio)) {
                    return redirect('myprofile')->with('success', 'update data success');
                } else {
                     return redirect()->back()->with('error', 'update data failed');
                }
                    } 
            }
            
        }

}

