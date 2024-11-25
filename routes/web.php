<?php

use App\Http\Controllers\KaprodiController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Routes;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::redirect('/', '/admin');

// Route::middleware(['guest'])->group(function(){
//     Route::get('/',[LoginController::class,'index'])->name('login');
//     Route::post('/',[LoginController::class,'login']);
//     });

Route::get('/home', function(){
    return redirect('/kaprodi');
});

Route::middleware(['auth'])->group(function(){
    Route::get('/kaprodi',[KaprodiController::class,'index']);
    Route::get('/kaprodi/kaprodi',[KaprodiController::class,'kaprodi'])->middleware('userAkses:kaprodi');
    Route::get('/kaprodi/dosen',[KaprodiController::class,'dosen'])->middleware('userAkses:dosen');
    Route::get('/kaprodi/dosen_wali',[KaprodiController::class,'dosen_wali'])->middleware('userAkses:dosen_wali');
    Route::get('/kaprodi/mahasiswa',[KaprodiController::class,'mahasiswa'])->middleware('userAkses:mahasiswa');
    Route::get('/logout',[LoginController::class,'logout']);
    });



