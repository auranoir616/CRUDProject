<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DataController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/', function(){
    return view('welcome');
});
Route::get('/loginpage', function(){
    return view('loginpage');
});

Route::get('/listusers',[DataController::class, "listUsers"]);
Route::get('/search',[DataController::class, 'search']);

Route::get('/profile/{username}',[DataController::class, 'profileData']);
Route::get('/messages/{datauser}',[DataController::class, 'messagesPage']);
// Route::get('/messages/{datauser}', function(User $datauser){
//     $sender = auth()->user();
//     $reciever = $datauser->id;
//     return view('message', compact('sender','reciever'));
// });


Route::post('/sendmsg',[DataController::class, 'sendMessages']);


Route::get('/post', function () {
    if(auth()->check()){
        return view('post');
    }else{
        return redirect('/');
    }
;
});

Route::get('/registerPage', function () {
    return view('register');
});


Route::get('/myprofile', [DataController::class, 'dataMyProfile']);

Route::get('/allpost', [PostController::class, 'allPost'])->name('allpost');

Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);
Route::post('/createpost', [PostController::class, 'createPost']);
Route::get('/logout', [UserController::class, 'logOut']);

Route::get('/editform/{post}',[PostController::class, "editForm"]);
Route::put('/editpost/{post}', [PostController::class, 'editPost']);

Route::delete('/deletepost/{post}', [PostController::class, 'deletePost']);

//route untuk menampilkan setiap post ke halaman baru
Route::get('/{post}', [PostController::class, 'viewPost']);

Route::post('/comment', [PostController::class, 'comment']);

Route::post('/likes/{post}', [PostController::class, 'like']);

Route::get('/editUserForm/{datauser}',[UserController::class, "editUserForm"]);
Route::put('/editUser/{datauser}',[UserController::class, 'editUser']);

