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

	Route::get('reportes/sistema', 'ReportesController@sistema')->name('sistema');
	Route::post('reportes/sistema', 'ReportesController@sistema')->name('sistemap');

	Route::get('reportes/navegador', 'ReportesController@navegador')->name('navegador');
	Route::post('reportes/navegador', 'ReportesController@navegador')->name('navegadorp');

	Route::get('reportes/dispositivo', 'ReportesController@dispositivo')->name('dispositivo');
	Route::post('reportes/dispositivo', 'ReportesController@dispositivo')->name('dispositivop');

	Route::get('reportes/contenido', 'ReportesController@contenido')->name('contenido');
	Route::post('reportes/contenido', 'ReportesController@contenido')->name('contenidop');

	Route::get('reportes/referidos', 'ReportesController@referidos')->name('referidos');
	Route::post('reportes/referidos', 'ReportesController@referidos')->name('referidosp');			
////

Route::get('perfil', 'UserController@index')->name('perfil');
Route::get('smartlinks', 'HomeController@smartlinks')->name('smartlinks');
Route::get('referidos', 'HomeController@referidos')->name('referidos');
Route::get('mensajes', 'HomeController@mensajes')->name('mensajes');
Route::post('mensajes', 'HomeController@mensajes')->name('mensajesp');

Route::post('perfil', 'UserController@updateperfil')->name('updateperfil');
Route::post('updateclave', 'UserController@updateclave')->name('updateclave');