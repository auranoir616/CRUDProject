<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Session;


class UserController extends Controller
{
    public function register(Request $request){
        $data = $request->validate([

            'registerName' => ['required'],
            'registerUsername' =>['required','min:4','max:12',Rule::unique('users','username')],
            'registerEmail' =>['required','email',Rule::unique('users','email')],
            'registerPassword' => ['required'],
            'registerImagesProfile' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048'

        ]);
        $data['registerPassword'] = bcrypt($data['registerPassword']);
        $file = $request->file('registerImagesProfile');
        if($request->hasFile('registerImagesProfile') && $file->isValid() && in_array($file->getClientOriginalExtension(), ['jpeg', 'png', 'jpg', 'gif','webp'])){
            $nama_file = time()."_profile_picture_".$file->getClientOriginalName();
            $folder_upload = 'data_file';

            if($file->move($folder_upload, $nama_file)){
                $data['registerImagesProfile'] = $nama_file;
                $user = User::create([
                    'name'=> $request->registerName,
                    'username'=>$request->registerUsername,
                    'email'=>$request->registerEmail,
                    'password'=>$request->registerPassword,
                    'Images_profile'=> $nama_file
                ]);
               return redirect('/');
            } else {
                return 'Gagal register';
            }
        }
       
    }
    public function login(Request $request){
        $data = $request->validate([
            'inputUsername' =>'required',
            'inputPassword' =>'required',
        ]);
        if(auth()->attempt(['username' => $data['inputUsername'], 'password' => $data['inputPassword']])){
            $request->session()->regenerate();
            // Mengambil objek user yang sedang diotentikasi
            $user = auth()->user();
            // Menyimpan username ke dalam session untuk digunakan di halaman /post
            session(['name' => $user->name,'email' => $user->email, 'images' => $user->Images_profile,]);
            return redirect('/mypost');
        }else{
            return redirect('/');
        }
       
    }

    public function logOut(){
        auth()->logout();
        return redirect('/');
            
        }

}
