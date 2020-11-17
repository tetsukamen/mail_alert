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

Route::group(['middleware' => 'auth'], function() {

    Route::get('/', 'AlertController@index');
    Route::get('/alert','AlertController@index')->name('alert.index') ;

    Route::get('/alert/create', 'AlertController@showCreateForm')->name('alert.create');
    Route::post('/alert/create', 'AlertController@create');

    Route::get('/alert/{id}/edit', 'AlertController@showEditForm')->name('alert.edit');
    Route::post('/alert/{id}/edit', 'AlertController@edit');

    Route::get('/alert/{id}/delete', 'AlertController@showDeleteForm')->name('alert.delete');
    Route::post('/alert/{id}/delete', 'AlertController@delete');

    Route::get('/alert/{id}/sendmail', 'AlertController@sendMail')->name('alert.sendMail');

});

Auth::routes();
