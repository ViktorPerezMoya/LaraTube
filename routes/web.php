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

//Route::get('/', function () {
//    return view('welcome');
//});

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

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

Route::get('/miniatura/{filename}',array(
    'as' => 'imagenVideo',
    'uses' => 'VideoController@getImagen'
));

Route::get('/video/{video_id}',array(
    'as' => 'videoDetalle',
    'uses' => 'VideoController@getVideoDetalle'
));

Route::get('/video-file/{filename}',array(
    'as' => 'fileVideo',
    'uses' => 'VideoController@getVideo'
));

Route::post('/comentar',array(
    'as' => 'comentarVideo',
    'middleware' => 'auth',
    'uses' => 'ComentarioController@store',
));

Route::get('/borrar-comentario/{comentario_id}',array(
    'as' => 'borrarComentario',
    'middleware' => 'auth',
    'uses' => 'ComentarioController@eliminarComentario'
));

Route::get('/borrar-video/{video_id}',array(
    'as' => 'borrarVideo',
    'middleware' => 'auth',
    'uses' => 'VideoController@eliminarVideo'
));

Route::get('/editar-video/{video_id}',array(
    'as' => 'editarVideo',
    'middleware' => 'auth',
    'uses' => 'VideoController@editarVideo'
));

Route::post('/update-video/{video_id}',array(
    'as' => 'updateVideo',
    'middleware' => 'auth',
    'uses' => 'VideoController@update'
));

Route::get('/buscar/{search?}/{filtro?}',array(
    'as' => 'videoSearch',
    'uses' => 'VideoController@search'
));

/* ruta para borrar cache de Laravel */
Route::get('clear-cache',function(){
    $code = Artisan::call('cache:clear');
});

Route::get('/canal/{user_id}',array(
    'as' => 'canal',
    'uses' => 'UserController@canal'
));

Route::get('/play-lists/{user_id}',array(
    'as' => 'playLists',
    'uses'=>'VideoController@playLists'
));

Route::get('new_play_list', array(
    'as' => 'newPlayList',
    'middleware' => 'auth',
    'uses'=>'VideoController@newPlayList'
));

Route::post('/insert_playlist',array(
    'as' => 'insertPlayList',
    'middleware' => 'auth',
    'uses' => 'VideoController@insertPlayList'
));

Route::get('/editar_playlist/{playlist_id}',[
    'as' => 'editarPlayList',
    'middleware' => 'auth',
    'uses' => 'VideoController@editarPlayList'
]);

Route::post('/update_playlist',[
    'as' => 'updatePlayList',
    'middleware' => 'auth',
    'uses' => 'VideoController@updatePlayList'
]);

Route::post('/like',[
    'as' => 'like',
    'uses' => 'VideoController@like'
]);