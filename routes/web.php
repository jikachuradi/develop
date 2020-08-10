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

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function() {
    //register リスト
    Route::get('register/create', 'Admin\RegisterController@add');
    Route::post('register/create', 'Admin\RegisterController@create');
    Route::get('register', 'Admin\RegisterController@index');
    Route::get('register/edit', 'Admin\RegisterController@edit');
    Route::post('register/edit', 'Admin\RegisterController@update');
    Route::get('register/delete', 'Admin\RegisterController@delete');
    //card　カード
    Route::get('card/create', 'Admin\CardController@add');
    Route::post('card/create', 'Admin\CardController@create');
    Route::get('card', 'Admin\CardController@index');
    Route::get('card/edit', 'Admin\CardController@edit');
    Route::post('card/edit', 'Admin\CardController@update');
    Route::get('card/delete', 'Admin\CardController@delete');
    
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');