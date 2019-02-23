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
    return view('uploadpage');
});

Route::prefix('api')->group(function () {
    Route::prefix('v1')->group(function () {
        Route::prefix('documents')->group(function () {

            Route::get('/', 'FileController@getAll');
            Route::get('/{document}/attachment/download/preview', 'FileController@getDocumentJpg');
            Route::get('/{document}/attachment/download', 'FileController@getDocumentPdf');
            Route::post('/{document}/attachment/upload', 'FileController@upload');
            Route::delete('/{document}', 'FileController@delDocumentPdf');

        });
    });
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
