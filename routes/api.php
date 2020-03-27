<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Petugas
Route::post('register', 'UserController@register');
Route::post('login', 'UserController@login');
Route::put('/ubah_petugas/{id}','UserController@update')->middleware('jwt.verify');
Route::delete('/hapus_petugas/{id}','UserController@destroy')->middleware('jwt.verify');
Route::get('/tampil_petugas','UserController@tampil_petugas')->middleware('jwt.verify');

// Jenis Cuci
Route::post('/simpan_jenis', 'JenisCuciController@store')->middleware('jwt.verify');
Route::put('/ubah_jenis/{id}','JenisCuciController@update')->middleware('jwt.verify');
Route::delete('/hapus_jenis/{id}','JenisCuciController@destroy')->middleware('jwt.verify');
Route::get('/tampil_jenis','JenisCuciController@tampil_jenis')->middleware('jwt.verify');

// Pelanggan
Route::post('/simpan_pelanggan', 'PelangganController@store')->middleware('jwt.verify');
Route::put('/ubah_pelanggan/{id}','PelangganController@update')->middleware('jwt.verify');
Route::delete('/hapus_pelanggan/{id}','PelangganController@destroy')->middleware('jwt.verify');
Route::get('/tampil_pelanggan','PelangganController@tampil_pelanggan')->middleware('jwt.verify');

// Pelanggan
Route::post('/simpan_transaksi', 'TransaksiController@store')->middleware('jwt.verify');
Route::post('/tampil_transaksi','TransaksiController@tampil_transaksi')->middleware('jwt.verify');

// Detail
Route::post('/simpan_detail', 'DetailController@store')->middleware('jwt.verify');
Route::get('/tampil_detail','DetailController@tampil_detail')->middleware('jwt.verify');
