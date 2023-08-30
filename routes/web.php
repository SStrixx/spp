<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Login; 
use App\Http\Controllers\Admin; 
use App\Http\Controllers\Siswa; 
use App\Http\Controllers\Spp;
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

Route::get('/login', [Login::class, 'index'])->name('login');
Route::post('/login/proses', [Login::class, 'proses']);
Route::get('/logout', [Login::class, 'logout'])->name('logout');
Route::get('/pembayaran', [Spp::class, 'index']);
Route::post('/pembayaran/save', [Spp::class, 'save']);
Route::delete('pembayaran/delete/{id}',[Spp::class, 'delete'])->name('pembayaran.delete');
Route::get('pembayaran/edit/{id}',[Spp::class, 'edit'])->name('pembayaran.edit');
Route::put('pembayaran/update/{id}',[Spp::class, 'update'])->name('pembayaran.update');
Route::get('/siswa',[Spp::class, 'index']);

Route::group(['middleware' => ['auth']], function () {
    Route::group(['middleware' =>['cekUserLogin:admin']], function () {
        Route::resource('admin', Admin::class);
    });
    Route::group(['middleware' =>['cekUserLogin:siswa']], function () {
        Route::resource('siswa', Siswa::class);
    });
});