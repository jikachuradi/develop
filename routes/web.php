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

/*Route::get('/home', function () {
    return view('welcome');
});*/

Route::get('/', 'Admin\WelcomeController@notice');

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function() {
    //register リスト
    Route::get('register/create', 'Admin\RegisterController@add');
    Route::post('register/create', 'Admin\RegisterController@create');
    Route::get('register', 'Admin\RegisterController@index');
    Route::get('register/edit', 'Admin\RegisterController@edit');
    Route::post('register/edit', 'Admin\RegisterController@update');
    Route::get('register/delete', 'Admin\RegisterController@delete');
    
    //template　テンプレート
    Route::get('template/create', 'Admin\TemplateController@add');
    Route::post('template/create', 'Admin\TemplateController@create');
    Route::get('template', 'Admin\TemplateController@index');
    Route::get('template/edit', 'Admin\TemplateController@edit');
    Route::post('template/edit', 'Admin\TemplateController@card_create');
    
    //card　カード
    Route::get('card', 'Admin\CardController@index');
    Route::get('card/edit', 'Admin\CardController@edit');
    Route::post('card/edit', 'Admin\CardController@update');
    Route::get('card/delete', 'Admin\CardController@delete');
    
    //メッセージカード作成用
    Route::post('template/aaa', 'Admin\TemplateController@card_create');
    Route::post('template/bbb', 'Admin\TemplateController@mb_wordwrape');
    
    Route::get('template/delete', 'Admin\TemplateController@delete');
});

Auth::routes();