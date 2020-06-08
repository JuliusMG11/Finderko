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

// auth

use Illuminate\Http\Request;

Auth::routes();


// home
Route::get('/', 'PostController@index')->name('home');

// posts
Route::resource('posts', 'PostController');

// comments
Route::resource('comments', 'CommentController')->only([
	'store', 'update', 'destroy'
]);

//users
Route::resource('users', 'UserController');

//renew token

Route::get('/renewToken', 'ApiTokenController@update');

// admin
Route::get('admin/{any?}', function () {
	return view('layouts.admin');
})->where('any', '.*')->middleware('auth');

Route::post('/flash-me', function(Request $request) {
	session()->flash('flash', $request->input('data'));
});


Route::get('/customer', function () {
    //
})->middleware('auth:api-customers');


Route::get('/login/writer', 'Auth\LoginController@showWriterLoginForm');
Route::post('/login/writer', 'Auth\LoginController@writerLogin');
Route::get('/register/writer', 'Auth\RegisterController@showWriterRegisterForm');
Route::post('/register/writer', 'Auth\RegisterController@createWriter');
Route::view('/writer', 'writer');