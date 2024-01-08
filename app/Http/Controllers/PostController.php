<?php

namespace App\Http\Controllers;

use App\Models\Post;
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
        $alldata = DB::table('allpost')->whereNotNull('title')->orderBy('updated_at', 'desc')->paginate(5);
        $comments = DB::table('userscomments')->orderBy('updated_at','desc')->get();
        return view('allpost',compact('alldata','comments'));
    }
    //oute untuk menampilkan form data edit
    public function editForm(Post $post){
        if(auth()->user()->id !== $post['user_id']){
            return redirect('/');
        }
        return view('editPostForm',['post'=>$post]);

  
    }
    //route untuk post data editing 
    public function editPost(Post $post, Request $request){
        if(auth()->user()->id !== $post['user_id']){
            return redirect('/');
        }
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
                $data['images'] =$nama_file;
            } else {
                return 'Gagal mengunggah file';
            }
        }
       $post->update($data);
       return redirect('mypost');
     

    }
    //route untuk delete post
    public function deletePost(Post $post){
        if(auth()->user()->id === $post['user_id']){
            $post->delete();
            return redirect('mypost')->with('success', 'Post berhasil dihapus');
        }
            return redirect('mypost')->with('error', 'Anda tidak memiliki izin untuk menghapus post ini');
    }
    //route untuk menampilkan tiap post ke page baru
    public function viewPost(Post $post){
        return view('viewpost', ['post'=>$post]);
    }
    //controller komentar
    public function comment(Request $request){
        $data = $request->validate([
            'body' => 'required',
        ]);
        if($data){
                $comment = new Comment;
                $comment->id_post = $request->input('id_post'); 
                $comment->body = $request->input('body');
                $comment->user_id = auth()->id();
                $comment->save();
                //agar tidak kembali ke page 1
            return redirect()->back(); 
        }else{
            return redirect('allpost')->with('error', 'Anda tidak memiliki izin');
        }
    }
    
}
