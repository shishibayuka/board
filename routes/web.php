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


// ログイン認証を行って
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
    // ログイン済みのユーザーは自動転送
])->group(function () {
    // homeにアクセス
    // Route::get('/', function () {
    //     // ※controllerの編集追記
    //     // viewsフォルダ内のlayouts→postを表示する
    //     return view('/layouts/post');
    // });
    Route::get('/', 'App\Http\Controllers\postsController@index');
});

// ホームのページを指定したら、postsControllerのindex部分を表示する
// Route::get('/', 'postsController@index')->name('posts.index');

Route::group(['prefix' => 'posts'], function () {

    //導線追加
    Route::get('show', 'App\Http\Controllers\postsController@show')->name('post.show');
    //追加
    Route::post('store', 'App\Http\Controllers\postsController@store')->name('post.store');
    //削除
    Route::post('destroy/{id}', 'App\Http\Controllers\postsController@destroy')->name('post.destroy');
});
