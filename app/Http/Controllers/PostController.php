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

class PostController extends Controller
{
    public function createPost(Request $request){
        $data = $request->validate([
            'title' => 'required',
            'body' => 'required',
            'images' => 'required|mimes:jpeg,png,jpg,gif,webp|max:2048'
        ]);
        $file = $request->file('images');
        $nama_file = time()."_".$file->getClientOriginalName();
        $folder_upload = 'data_file';
        if($file->move($folder_upload, $nama_file)){
            $saveData = Post::create([
                'title' => $request->title,
                'body' => $request->body,
                'images' =>$nama_file,
                'user_id' =>auth()->id()
            ]);
            return redirect('post')->with('success', 'Post berhasil ditambahkan');
        }else{
            return redirect('post')->with('error', 'Anda tidak memiliki izin');
        }
    }
    //mendapatkan semua data dari VIEW post dan menampilkannya secara descending 
    public function allPost(){
        if(auth()->check()){
        try{
        $userId = auth()->user()->id;
        $user = User::find($userId);
        $postdata = Post::join('follower',function($join) use ($userId){
             $join->on('post.user_id', '=', 'follower.following_user');
                // ->orOn('post.user_id','=','follower.following_user');
            })
                ->join('users','post.user_id','=','users.id')
                ->where('follower.user_id', $userId)
                ->select('post.*','users.name')
                ->whereNotNull('title')
                ->orderBy('created_at', 'desc')
                ->paginate(5);
        $comments = DB::table('userscomments')->orderBy('updated_at')->get();
         } catch (\Exception $e) {
            dd($e->getMessage());
         }
        $postIDs = $postdata->pluck('id');
        $likes = Likes::whereIn('post_id', $postIDs)->get();
        $likesCount = $likes->groupBy('post_id')->map->count();
        return view('allpost',compact('postdata','comments','likesCount',));
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
                'title'=> 'required',
                'body'=> 'required',
                'images' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
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
        $appUrl = url('/');
        $page = $appUrl.'/'.$id.'-'.$title;
        $sharepage = Share::page( $page,'share my prototype web')
        ->facebook()
        ->twitter()
        ->linkedin()
        ->whatsapp()
        ->pinterest()
        ->telegram()
        ->reddit()
        ->getRawLinks();
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
        return redirect()->back();
}

}