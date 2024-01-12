<?php

namespace App\Http\Controllers;

use Share;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Messages;

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
        $sender = auth()->user();
        $reciever = $datauser->id;
        //!
        return view('message', compact('sender','reciever'));

    }

    public function sendMessages(Messages $msg, Request $request){
        $data = $request->validate([
            'content' => 'required',
        ]);
        if($data){
            $messages = new Messages;
            $messages->content = $request->input('content'); 
            $messages->recipient_id = $request->input('reciever');
            $messages->user_id = auth()->id();
            $messages->save();
            //agar tidak kembali ke page 1
        return redirect()->back(); 
    }else{
        return redirect()->back()->with('error', 'Anda tidak memiliki izin');
    }



    }
}
