<?php

use App\Http\Controllers\CariController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LikeKomenController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfilController;
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

Route::get('/back', function () {
    return view('test');
});

//SIGN
Route::get('/signin', [LoginController::class, 'signinPage'])->name('login')->middleware('guest');
Route::get('/signup', [LoginController::class, 'signupPage'])->name('signup')->middleware('guest');
Route::post('/aksisignin', [LoginController::class, 'signin'])->name('aksisignin');
Route::post('/aksisignup', [LoginController::class, 'signup'])->name('aksisignup');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

//home
Route::get('/', [HomeController::class, 'index'])->name('home')->middleware('auth');
Route::get('/isi', [HomeController::class, 'isi'])->name('isi')->middleware('auth');

//profil
Route::get('/profil/foto', [ProfilController::class, 'foto'])->name('profil')->middleware('auth');
Route::get('/profil/album', [ProfilController::class, 'album'])->name('profil-album')->middleware('auth');
Route::get('/profil/album/topAlbum', [ProfilController::class, 'topAlbum'])->name('profil-topAlbum')->middleware('auth');
Route::get('/profil/editprofil', [ProfilController::class, 'edit'])->name('edit-profil')->middleware('auth');
Route::post('/profil/update', [ProfilController::class, 'update'])->name('update-profil')->middleware('auth');
Route::post('/profil/updatePW', [ProfilController::class, 'updatePassword'])->name('update-password')->middleware('auth');
Route::post('/profil/updatePic', [ProfilController::class, 'updatePic'])->name('update-pic')->middleware('auth');
Route::post('/profil/deletePic', [ProfilController::class, 'deletePic'])->name('delete-pic')->middleware('auth');

//post
Route::get('/post-album', [PostController::class, 'index'])->name('post-album')->middleware('auth');
Route::get('/post-photo', [PostController::class, 'index2'])->name('post-photo')->middleware('auth');
Route::post('/toKeranjang', [PostController::class, 'toKeranjang'])->name('to-keranjang')->middleware('auth');
Route::post('/hapusKeranjang/{id}', [PostController::class, 'hapusKeranjang'])->middleware('auth');
Route::post('/albumInsert', [PostController::class, 'albumInsert'])->name('insert-album')->middleware('auth');
Route::post('/fotoInsert', [PostController::class, 'fotoInsert'])->name('insert-foto')->middleware('auth');

Route::get('/foto/{id}', [ProfilController::class, 'detailFoto'])->name('detail-foto')->middleware('auth');
Route::get('/album/{id}', [ProfilController::class, 'detailAlbum'])->name('detail-album')->middleware('auth');

Route::post('/deleteFoto/{id}', [PostController::class, 'deleteFoto'])->name('delete-foto')->middleware('auth');
Route::post('/deleteAlbum/{id}', [PostController::class, 'deleteAlbum'])->name('delete-album')->middleware('auth');

Route::post('/editFoto/{id}', [PostController::class, 'editFoto'])->name('edit-foto')->middleware('auth');
Route::post('/editAlbum/{id}', [PostController::class, 'editAlbum'])->name('edit-album')->middleware('auth');

Route::post('/post-photo/=', [PostController::class, 'pilihAlbum'])->name('pilih-album')->middleware('auth');

//user 
Route::get('/profil/{id}', [UserController::class, 'foto'])->middleware('auth');
Route::get('/profil/{id}/album', [UserController::class, 'album'])->middleware('auth');

//like
Route::get('/like/{foto_id}/{user_id}', [LikeKomenController::class, 'like'])->name('like')->middleware('auth'); //no reload
Route::post('/like', [LikeKomenController::class, 'like2'])->name('like2')->middleware('auth');
Route::get('/unlike/{like_id}', [LikeKomenController::class, 'unlike'])->name('unlike')->middleware('auth'); //no reload
Route::post('/unlike', [LikeKomenController::class, 'unlike2'])->name('unlike2')->middleware('auth');

//komen
Route::get('/komen/{id}', [LikeKomenController::class, 'komen'])->name('komen')->middleware('auth'); //no reload
Route::post('/komen', [LikeKomenController::class, 'komen2'])->name('komen2')->middleware('auth');
Route::get('/deleteKomen/{komen_id}', [LikeKomenController::class, 'deleteKomen'])->name('delete-komen')->middleware('auth'); //no reload
Route::post('/deleteKomen', [LikeKomenController::class, 'deleteKomen2'])->name('delete-komen2')->middleware('auth'); //no reload

//cari
Route::get('/cari', [CariController::class, 'cari'])->name('cari')->middleware('auth');
Route::get('/cari/album', [CariController::class, 'carialbum'])->name('cari-album')->middleware('auth');
Route::get('/cari/foto', [CariController::class, 'carifoto'])->name('cari-foto')->middleware('auth');
Route::get('/cari/user', [CariController::class, 'cariuser'])->name('cari-user')->middleware('auth');
