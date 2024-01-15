<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Session;


class UserController extends Controller
{

    public function loginPage(){
        return view('welcome');
    }
    public function registerPage(){
        return view('register');
    }

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
               return redirect('/')->with('success', 'berhasil register');
            }else {
                return redirect('/')->with('error', 'gagal register');
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
            return redirect('/myprofile')->with('success', 'berhasil login');;
        }else{
            return redirect('/')->with('error','Username atau password salah');
        }
       
    }

    public function logOut(){
        auth()->logout();
        return redirect('/')->with('success', 'berhasil logout');
            
        }

        public function editUserForm(User $datauser){
            if(!auth()->user()->id ){
                return redirect('/');
            }
            // dd($user);
            return view('editUserForm',['datauser'=>$datauser]);
        }
    

        public function editUser(User $datauser, Request $request)
        {
            // Periksa apakah pengguna yang diotorisasi sedang masuk
            if (!auth()->check()) {
                return redirect('/');
            }
            // Validasi data dari formulir
            $data = $request->validate([
                'editName' => ['required','sometimes'],
                'editUsername' => ['required','sometimes', 'min:4', 'max:12', Rule::unique('users', 'username')->ignore($datauser->id)],
                'editEmail' => ['required','sometimes', 'email', Rule::unique('users', 'email')->ignore($datauser->id)],
                'editPassword' => ['sometimes', 'required', 'min:4'],
                'editImagesProfile' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048'
            ]);
        
            // Update password jika ada perubahan
            if (isset($data['editPassword'])) {
                $data['editPassword'] = bcrypt($data['editPassword']);
            }
            // Proses upload gambar dan penyimpanan data pengguna
            if ($request->hasFile('editImagesProfile')) {
                $file = $request->file('editImagesProfile');
                $nama_file = time() . "_" . $file->getClientOriginalName() . '_UserEdited';
                $folder_upload = 'data_file';
                // Simpan data pengguna ke dalam array untuk proses update
                $userData = [
                    'name' => $request->editName,
                    'username' => $request->editUsername,
                    'email' => $request->editEmail,
                    'password' => $data['editPassword'] ?? null,
                    'Images_profile' => $nama_file
                ];
                // Update data pengguna
                $updated = $datauser->update($userData);
        
                // Pindahkan file gambar ke folder upload jika update berhasil
                if ($updated) {
                    if ($file->move($folder_upload, $nama_file)) {
                        return redirect('myprofile')->with('success', 'Data user berhasil diupdate');
                    } else {
                        return redirect('myprofile')->with('error', 'Gagal mengunggah file');
                    }
                } else {
                    return redirect('myprofile')->with('error', 'Gagal mengupdate data user');
                }
            }
            return redirect('myprofile')->with('success', 'Data user berhasil diupdate');
        }
        
}
