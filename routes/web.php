<?php

use Illuminate\Support\Facades\Route;
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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/post', function () {
    if(auth()->check()){
        return view('post');
    }else{
        return redirect('/');

    }
;
});

Route::get('/registerPage', function () {
    notify()->success('Laravel Notify is awesome!');

    return view('register');
});


Route::get('/mypost', function () {
    $postdata = [];
    $userdata = [];
        if(auth()->check()){
        $userdata = auth()->user()->get();
        $postdata = auth()->user()->usersPosts()->latest()->get();
        return view('mypost', ['postdata'=>$postdata]);
    }else{
        return redirect('/');

    }

});

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






