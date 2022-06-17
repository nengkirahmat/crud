<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('dashboard');
});

    Route::get('/jurusan', [App\Http\Controllers\JurusanController::class, 'index']);
	Route::post('/jurusanTable', [App\Http\Controllers\JurusanController::class, 'index']);
	Route::post('/jurusan/simpan', [App\Http\Controllers\JurusanController::class, 'store']);
	Route::get('/jurusan/{id}/edit', [App\Http\Controllers\JurusanController::class, 'edit']);
	Route::get('/jurusan/hapus/{id}', [App\Http\Controllers\JurusanController::class, 'delete']);


    Route::get('/prodi', [App\Http\Controllers\ProdiController::class, 'index']);
	Route::post('/prodiTable', [App\Http\Controllers\ProdiController::class, 'index']);
	Route::post('/prodi/simpan', [App\Http\Controllers\ProdiController::class, 'store']);
	Route::get('/prodi/{id}/edit', [App\Http\Controllers\ProdiController::class, 'edit']);
	Route::get('/prodi/hapus/{id}', [App\Http\Controllers\ProdiController::class, 'delete']);
    Route::get('/prodi/get/{id}', [App\Http\Controllers\ProdiController::class, 'getData']);


