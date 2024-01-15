<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Likes;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Notifications\deleteNotif;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Share;
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
        try{
       $user = auth()->id();
        $alldata = DB::table('allpost')->whereNotNull('title')->orderBy('created_at', 'desc')->paginate(5);
        $comments = DB::table('userscomments')->orderBy('updated_at','desc')->get();
        $allusers = DB::table('users')->whereNotIn('id',[$user])->get();
         } catch (\Exception $e) {
            dd($e->getMessage());
         }

        $postIDs = $alldata->pluck('id');
        $likes = Likes::whereIn('post_id', $postIDs)->get();
        $likesCount = $likes->groupBy('post_id')->map->count();
        return view('allpost',compact('alldata','comments','likesCount','allusers'));
       
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
       return redirect('myprofile')->with('success', 'Data berhasil diupdate');
     

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