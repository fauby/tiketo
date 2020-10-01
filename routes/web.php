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
    return view('welcome');
});

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/home-concert', 'HomeController@index_concert')->name('home');

Route::get('/home-sport', 'HomeController@index_sport')->name('home');

Auth::routes();

Route::get('/pesan/{id}', 'PesanController@index')->name('pesan')->middleware('auth');

Route::post('/pesan/{id}', 'PesanController@pesan')->middleware('auth');

Route::get('check-out', 'PesanController@check_out')->middleware('auth');

Route::delete('check-out/{id}', 'PesanController@delete')->middleware('auth');

Route::get('konfirmasi-check-out', 'PesanController@konfirmasi')->middleware('auth');

Route::get('payment', 'PesanController@konfirmasi')->middleware('auth');

Route::post('charge', 'PesanController@charge')->middleware('auth');

Route::get('profile', 'ProfileController@index')->middleware('auth');

Route::post('profile', 'ProfileController@update')->middleware('auth');

Route::get('history', 'HistoryController@index')->middleware('auth');

Route::get('history/{id}', 'HistoryController@detail')->middleware('auth');

Route::group(['middleware' => ['auth', 'admin']], function () {

    Route::get('admin-user', 'AdminController@user')->name('user')->middleware('auth');

    Route::delete('admin-user/{id}', 'AdminController@userdelete')->name('user')->middleware('auth');

    Route::get('admin-cat', 'AdminController@category')->middleware('auth');

    Route::get('admin-product', 'AdminController@product')->middleware('auth');

    Route::get('admin-product-add', 'AdminController@productaddshow')->middleware('auth');

    Route::post('admin-product-add', 'AdminController@productadd')->middleware('auth');

    Route::get('admin-product/{id}', 'AdminController@productdetail')->middleware('auth');

    Route::post('admin-product/{id}', 'AdminController@productupdate')->middleware('auth');

    Route::delete('admin-product/{id}', 'AdminController@productdelete')->middleware('auth');

    Route::get('admin-pesanan', 'AdminController@pesanan')->name('pesanan')->middleware('auth');

    Route::get('admin-pesanan/{id}', 'AdminController@pesanandetail')->name('pesanan')->middleware('auth');
});






