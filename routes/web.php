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

// // ログインにアクセスすると、右を表示する
// Route::get('/login', 'App\Http\Controllers\UsersController@showLoginView');
// Route::get('/login', '/profile/login');
// ログイン認証を行って
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
    // ログイン済みのユーザーは自動転送
])->group(function () {
    // homeにアクセス
    Route::get('/', function () {
        // viewsフォルダ内のlayouts→postを表示する
        return view('/layouts/post');
    });
});





