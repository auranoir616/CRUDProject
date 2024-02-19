<?php

namespace App\Http\Controllers;

use Share;
use App\Models\Post;
use App\Models\User;
use App\Models\Likes;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Notifications\deleteNotif;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Carbon\Carbon;

class PostController extends Controller
{
public function formatTimeAgo($updatedAt){
    $updatedTime = Carbon::parse($updatedAt);
    $now = Carbon::now();

    if ($updatedTime->diffInDays($now) > 0) {
        return $updatedTime->diffInDays($now) . ' days ago';
    } elseif ($updatedTime->diffInHours($now) > 0) {
        return $updatedTime->diffInHours($now) . ' hours ago';
    } elseif ($updatedTime->diffInMinutes($now) > 0) {
        return $updatedTime->diffInMinutes($now) . ' minutes ago';
    } else {
        return 'Just now';
    }
}

    //generate link share page
    public function SharePage(){
        $appUrl = url('/');
        $page = $appUrl.'/';
        return Share::page( $page,'share my post')
        ->facebook()
        ->twitter()
        ->linkedin()
        ->whatsapp()
        ->pinterest()
        ->telegram()
        ->reddit()
        ->getRawLinks();
        }

    public function createPost(Request $request){
        $data = $request->validate([
            'body' => 'required',
            'images' => 'nullable|mimes:jpeg,png,jpg,gif,webp|max:2048'
        ]);
        $file = $request->file('images');
        $saveDataPost = [
            'body' => $request->body,
            // 'images' =>$nama_file,
            'user_id' =>auth()->id()
        ];
        $folder_upload = 'data_file';
        if ($request->hasFile('images') && $file->isValid() && in_array($file->getClientOriginalExtension(), ['jpeg', 'png', 'jpg', 'gif', 'webp'])) {
            $nama_file = time()."_".$file->getClientOriginalName();
            if($file->move($folder_upload, $nama_file)){
            $saveDataPost['images'] = $nama_file;
        }else{
            return redirect('post')->with('error', 'upload gambar gagal');
        }
    }
        if (Post::create($saveDataPost)) {
            return redirect()->back()->with('success', 'save data berhasil');
        }
        return redirect()->back()->with('error', 'upload data gagal');
    }
    //mendapatkan semua data dari VIEW post dan menampilkannya secara descending 
    public function allPost(){
        if(auth()->check()){
        try{
        $userId = auth()->user()->id;
        $user = User::find($userId);
        //join untuk menampilkan data dari user yang difollow
        $postdata = Post::join('follower',function($join) use ($userId){
             $join->on('post.user_id', '=', 'follower.following_user');
            })
                ->join('users','post.user_id','=','users.id')
                ->where('follower.user_id', $userId)
                ->select('post.*','users.name','users.Images_profile','users.username','users.id as user_id')
                ->whereNotNull('body')
                ->inRandomOrder()
                ->paginate(5);
                  //format waktu sebelum ditampilkan
        foreach($postdata as $data) {
            $data->formatted_updated_at = $this->formatTimeAgo($data->updated_at);
        }
      
        //untuk menampilkan komentar
        $comments = DB::table('userscomments')->orderBy('updated_at')->get();
         } catch (\Exception $e) {
            dd($e->getMessage());
         }
         //mendapatkan data kolom following_user dalam bentuk array
        $followingUserId = DB::table('follower')->where('user_id',$userId)->pluck('following_user')->toArray();
        //menapatkan data dari table follower yang belum difollow dengan membandingkan dengan $followingUserId
        $sugestedUsers = DB::table('users')
        ->whereNotIn('id',$followingUserId)
        ->where('id','<>',$userId)
        ->inRandomOrder()
        ->take(3)
        ->get();
        //mendapatkan data array dari hasil join $postdata untuk mencari jumlah likesnya
        $postIDs = $postdata->pluck('id');
        $postToShare = Post::select('id')->get();
         foreach($postToShare as $data){
             $sharepage = $this->SharePage($data);
            //  dd($data);
            }
        $likes = Likes::whereIn('post_id', $postIDs)->get();
        $likesCount = $likes->groupBy('post_id')->map->count();
        return view('allpost',compact('postdata','comments','likesCount','sugestedUsers','sharepage'));
        }else{
            return view('loginpage');
        }  
    }
    //oute untuk menampilkan form data edit
    public function editForm(Post $post){
        if(auth()->check()){

        if(auth()->user()->id == $post['user_id']){
            return view('editPostForm',['post'=>$post]);
        }else{
            return redirect()->back()->with('error', 'gagal update data');
        }
    }else{
        return view('loginpage');
    }  
    }
    //route untuk post data editing 
    public function editPost(Post $post, Request $request){
        if(auth()->check()){
        if(auth()->user()->id == $post['user_id']){
            $data = $request->validate([
                'body'=> 'required',
                'images' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048'
            ]);
            if($request->hasFile('images')){
                $file = $request->file('images');
                $nama_file = time()."_".$file->getClientOriginalName().'_edited';
                $folder_upload = 'data_file';
    
                if($file->move($folder_upload, $nama_file)){
                    $data['images'] = $nama_file;
                } else {
                    return redirect()->back()->with('error', 'gagal update data');
                }
            }
           $post->update($data);
           return redirect('myprofile')->with('success', 'Data berhasil diupdate');
         
        }else{
            return redirect()->back()->with('error', 'gagal update data');

        }
    }else{
        return view('loginpage');
    }  

      

    }
    //route untuk delete post
    public function deletePost(Post $post){
        // $msg = auth()->user()->id == $post['user_id'];
        if(auth()->user()->id == $post['user_id']){
            $post->delete();
        //  dd('ok',$msg);
            return redirect('myprofile')->with('success', 'Post berhasil dihapus');
        }
        // dd('error',$msg);
            return redirect('myprofile')->with('error', 'Anda tidak memiliki izin untuk menghapus post ini');
    }
    //route untuk menampilkan tiap post ke page baru
    //menambahkan fitur share page
    public function viewPost(Post $post){
        if(auth()->check()){
        $id = $post->id;
        $title = $post->title;
        $link = $id.'-'.$title;
        $sharepage = $this->SharePage($link);
        return view('viewpost',compact('sharepage','post'));
        }else{
            return view('loginpage');
        }  
        }
    //controller komentar
    public function comment(Request $request){
        $data = $request->validate([
            'body' => 'required',
        ]);
        if($data){
                $comment = new Comment;
                $comment->id_post = $request->input('postId'); 
                $comment->body = $request->input('body');
                $comment->user_id = auth()->id();
                $comment->save();
                //agar tidak kembali ke page 1
            return redirect()->back(); 
        }else{
            return view('allpost')->with('error', 'Anda tidak memiliki izin');
        }
    }
    
    public function like(Request $request){
        $user = auth()->user();
        $postId = $request->input('postId');
        // Cek apakah user sudah melakukan like pada post tertentu
        $existingLike = Likes::where('user_id', $user->id)
                            ->where('post_id', $postId)
                            ->first();
        if ($existingLike) {
            // Jika sudah ada like, hapus like tersebut
            $existingLike->delete();
        } else {
            // Jika belum ada like, tambahkan like baru
            $like = new Likes;
            $like->user_id = $user->id;
            $like->post_id = $postId;
            $like->save();
        }
        return response()->json(['existingLike' => $existingLike]);
        // return redirect()->back();
}
        public function likeCount(Post $post){
            $user = auth()->user();
            $postId = $post->id;
            $CountLikesPost = Likes::where('post_id', $postId)->count();
            return response()->json(['CountLikesPost' => $CountLikesPost]);
            // return redirect()->back();
        }


}