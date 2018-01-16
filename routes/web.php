<?php

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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('perfil', 'UserController@index')->name('perfil');
Route::post('perfil', 'UserController@updateperfil')->name('updateperfil');
Route::post('updateclave', 'UserController@updateclave')->name('updateclave');