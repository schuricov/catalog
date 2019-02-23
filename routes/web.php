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
//    return view('downloadpage');
    return view('uploadpage');
//    return view('home');
//    return view('welcome');
});


Route::prefix('api')->group(function () {
    Route::prefix('v1')->group(function () {
        Route::prefix('documents')->group(function () {

            Route::get('/', 'FileController@getAll');
            Route::get('/{document}/attachment/download/preview', 'FileController@getDocumentJpg');
            Route::get('/{document}/attachment/download', 'FileController@getDocumentPdf');
            Route::post('/{document}/attachment/upload', 'FileController@upload');
            Route::delete('/{document}', 'FileController@delDocumentPdf');

//            Route::match(['get', 'post'], '/{document}/attachment/upload', 'FileController@upload');

//    Route::get('users', function () {
////         Matches The "/admin/users" URL
//    });

        });
    });
});

//Route::get('/image/upload/', 'FileController@download');



//Route::any('/attachment/upload', 'FileController@upload');
//Route::any('/{document}/attachment/upload', 'FileController@upload');


//Route::post('/image/upload/', 'FileController@upload')->name('image.upload');
//Route::post('/attachment/upload/{test}/temp', 'FileController@upload')->name('image.upload');



//Route::post('/{id}/attachment/upload', 'FileController@upload')->name('image.upload');

//Route::any('/image/upload/', 'FileController@upload')->name('image.upload');
//Route::get('/image/upload/', 'FileController@upload')->name('image.upload');


//Route::get('/{id}/attachment/upload', 'FileController@upload')->name('image.upload');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
