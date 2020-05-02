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


Auth::routes();

Route::get('/' , 'ReviewController@index')->name('index');

// /show/{id}のidとはreviewsテーブルのidを指す。レビュー詳細ページのURLは閲覧するレビューによって変化
Route::get('/show/{id}', 'ReviewController@show')->name('show');


// ログイン認証した人だけアクセス可能
Route::group(['middleware' => 'auth'], function () {

    Route::get('/review', 'ReviewController@create')->name('create');
    
    Route::post('/review/store', 'ReviewController@store')->name('store');

});

Route::get('/home', 'HomeController@index')->name('home');