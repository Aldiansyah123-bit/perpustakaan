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
    return view('auth.login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Kategori
Route::get('/master/kategori', 'KategoriController@index');
Route::get('/master/kategori/add', 'KategoriController@store');
Route::post('/master/kategori/create', 'KategoriController@create');
Route::get('/master/kategori/edit/{id}', 'KategoriController@edit');
Route::put('/master/kategori/update/{id}', 'KategoriController@update');
Route::get('/master/kategori/delete/{id}', 'KategoriController@destroy');

//Buku
Route::get('/master/buku', 'BukuController@index');
Route::get('/master/buku/kosong', 'BukuController@show');
Route::get('/master/buku/nonaktif', 'BukuController@nonaktif');
Route::get('/master/buku/add', 'BukuController@store');
Route::post('/master/buku/create', 'BukuController@create');
Route::get('/master/buku/edit/{id}', 'BukuController@edit');
Route::put('/master/buku/update/{id}', 'BukuController@update');
Route::get('/master/buku/delete/{id}', 'BukuController@destroy');
Route::get('/master/buku/status/{id}', 'BukuController@status');

