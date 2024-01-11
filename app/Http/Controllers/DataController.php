<?php

namespace App\Http\Controllers;

use Share;
use App\Models\Post;
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


}
