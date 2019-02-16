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
    return view('downloadpage');
//    return view('upload');
//    return view('home');
//    return view('welcome');
});


Route::prefix('api')->group(function () {
    Route::prefix('v1')->group(function () {
        Route::prefix('documents')->group(function () {

            Route::match(['get', 'post'], '/{id}/attachment/upload', 'FileController@upload');



//    Route::get('users', function () {
////         Matches The "/admin/users" URL
//    });

        });
    });
});


Route::post('/image/upload/', 'FileController@upload')->name('image.upload');
//Route::get('/image/upload/', 'FileController@upload')->name('image.upload');


//Route::get('/{id}/attachment/upload', 'FileController@upload')->name('image.upload');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
