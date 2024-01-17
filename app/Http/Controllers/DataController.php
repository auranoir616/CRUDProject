<?php

namespace App\Http\Controllers;

use Share;
use App\Models\Post;
use App\Models\User;
use App\Models\Likes;
use App\Models\Messages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DataController extends Controller

{
    //untuk pagination halaman
    public function footerData(){
        $alldata = DB::table('allpost')->whereNotNull('title')->orderBy('updated_at', 'desc')->paginate(5);
        return view('_footer',compact('alldata'));

    }
    //menampilkan data user yang terdaftar
    public function profileData($username){
        $dataUser = DB::table('allpost')->where('username', $username)->get();
        return view('profileusers', ['dataUser' => $dataUser]);

    }

    public function search(Request $request){
        $data = $request->input('query');

        $results = Post::where('title','like',"%$data%")
                        ->get();
        // dd($results);
        return view('searchResults', compact('results'));
    }

    public function messagesPage(User $datauser){
        $sender = auth()->id();
        $receiver = $datauser->id;
        $receiverName = $datauser->name;
        $sendto = $sender.$receiver;
        $receivefrom = $receiver.$sender;
        $userdata = DB::table('users')->whereNotIn('id',[$sender])->get();
        $messagesSender = DB::table('messages')
                            ->where('id_chat',$sendto)
                            ->orwhere('id_chat',$receivefrom)
                            ->orderBy('updated_at','desc')
                            ->get();

        return view('message', compact('sender','receiver','messagesSender','userdata','datauser','receiverName'));
    }

    public function sendMessages(Messages $msg, Request $request){
        $data = $request->validate([
            'content' => 'required',
        ]);
        $sender = auth()->user();
        $receiver = $request->input('reciever');
        if($data){
            $messages = new Messages;
            $messages->content = $request->input('content'); 
            $messages->recipient_id = $request->input('reciever');
            $messages->id_chat = $sender->id.$request->input('reciever');
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
        $allusers = DB::table('users')->whereNotIn('id',[$user])->get();

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
                $comments = DB::table('userscomments')->orderBy('updated_at','desc')->get();
                return view('profile', compact('postdata','likesCount','comments'));
            }else{
                return redirect('/');
        
            }
        
    }
}
