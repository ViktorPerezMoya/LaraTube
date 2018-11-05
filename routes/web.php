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

//rutas del controlador de videosr
Route::get('/crear-video',array(
    'as' => 'crearVideo',
    'middleware' => 'auth',
    'uses' => 'VideoController@crearVideo'
));

Route::post('/guardar-video',array(
    'as' => 'guardarVideo',
    'middleware' => 'auth',
    'uses' => 'VideoController@guardarVideo'
));