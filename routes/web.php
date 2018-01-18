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
Route::get('salir', 'HomeController@logout')->name('salir');
//Reportes
	Route::get('reportes/general', 'ReportesController@index')->name('general');
	Route::post('reportes/general', 'ReportesController@index')->name('generalp');
	Route::get('reportes/paises', 'ReportesController@paises')->name('paises');
	Route::post('reportes/paises', 'ReportesController@paises')->name('paisesp');
////

Route::get('perfil', 'UserController@index')->name('perfil');
Route::post('perfil', 'UserController@updateperfil')->name('updateperfil');
Route::post('updateclave', 'UserController@updateclave')->name('updateclave');