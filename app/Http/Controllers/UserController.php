<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Follow;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{

    public function registerPage(){
        return view('register');
    }

    public function register(Request $request){
        $data = $request->validate([
            'registerName' => ['required'],
            'registerUsername' =>['required','min:4','max:12',Rule::unique('users','username')],
            'registerEmail' =>['required','email',Rule::unique('users','email')],
            'registerPassword' => ['required'],
            'registerImagesProfile' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048'
        ],[
            'registerName.required' =>'>Name must be filled ',
            'registerUsername.required' =>'>Usename must be filled ',
            'registerEmail.required' =>'>email must be filled ',
            'registerPassword.required' =>'>password must be filled ',
            'registerImagesProfile.required' =>'>images must be filled '
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
                //untuk menambahkan data pada tabel follower agar bisa melihat post sendiri
                $follow = new Follow;
                $follow->user_id = $user->id;
                $follow->following_user =$user->id;
                $follow->save();
    
               return redirect('/loginpage')->with('success', 'registration success, please login...');
            }else {
                return redirect('/')->with('error', 'registration failed');
            }
        }
       
    }
    public function login(Request $request){
        $data = $request->validate([
            'inputUsername' =>'required',
            'inputPassword' =>'required',
        ], [
            'inputUsername.required' => 'Username must be filled',
            'inputPassword.required' => 'Password must be filled',
        ]);
        if(auth()->attempt(['username' => $data['inputUsername'], 'password' => $data['inputPassword']])){
            $request->session()->regenerate();
            // Mengambil objek user yang sedang diotentikasi
            $user = auth()->user();
            // Menyimpan username ke dalam session untuk digunakan di halaman /post
            session(['name' => $user->name,'email' => $user->email, 'images' => $user->Images_profile,]);    
            return redirect('/myprofile')->with('success', 'berhasil login');
        }else{
            return redirect()->back()->with('error','Username or password is Incorrect');
        }
       
    }

    public function logOut(){
        auth()->logout();
        return redirect('/')->with('success', 'Logout Success');
            }
    
    public function editUserForm(User $datauser){
            if(!auth()->user()->id ){
                return redirect('/');
            }
            return view('editUserForm',['datauser'=>$datauser]);
        }

public function editUser(User $datauser, Request $request){
    if(auth()->check()){

    if(auth()->user()->id == $datauser['id']){
    // Validasi data dari formulir
    $data = $request->validate([
        'editName' => 'required',
        'editUsername' => ['required', 'min:4', 'max:12', Rule::unique('users', 'username')->ignore($datauser->id)],
        'editEmail' => ['required', 'email', Rule::unique('users', 'email')->ignore($datauser->id)],
        'editPassword' => ['sometimes', 'min:4'],
        'editBio'=> 'required',
        'editImagesProfile' => 'sometimes','nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048'
    ]);
    $file = $request->file('editImagesProfile');
    if ($request->hasFile('editImagesProfile')) {
        $nama_file = time() . "_" . $file->getClientOriginalName();
        $folder_upload = 'data_file';
        if($file->move($folder_upload, $nama_file)){
            $data['editImagesProfile'] = $nama_file;
            $newdata =[
                'name' => $request->editName,
                'username' => $request->editUsername,
                'email' => $request->editEmail,
                // 'password' => $data['editPassword'] ?? null,
                'bio'=> $request->editBio,
                'Images_profile' => $nama_file
            ];
            //validasi format gambar
            if(!$file->isValid() && !in_array($file->getClientOriginalExtension(), ['jpeg', 'png', 'jpg', 'gif','webp'])){
                return redirect()->back()->with('error', 'update data failed');
            }
            // Update data pengguna
            $datauser->update($newdata);
            if ($datauser->update($newdata)) {
                return redirect('myprofile')->with('success', 'update data success');
            } else {
                return redirect()->back()->with('error', 'update data failed');
            }
        } 
        //jika tidak upload ulang gambar
    }else{
         $nama_file = $datauser->Images_profile;
         $newdata =[
            'name' => $request->editName,
            'username' => $request->editUsername,
            'email' => $request->editEmail,
            'bio'=> $request->editBio,
            'Images_profile' => $nama_file
         ];
        // Update data pengguna
        $datauser->update($newdata);
        if ($datauser->update($newdata)) {
            // dd($datauser->update($newdata));
            return redirect('myprofile')->with('success', 'update data success');
        } else {
            return redirect()->back()->with('error', 'update data failed');
        }
    }
    
}
}else{
    return view('loginpage');
}  

}

 }
        
          