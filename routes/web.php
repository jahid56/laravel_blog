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
    return view('index');
});

/*
 Registration Route
*/
Route::get('register', 'RegistrationController@register');
Route::post('register/store', 'RegistrationController@create');
/*
 Login Route
*/
Route::get('login', 'LoginController@login');
Route::post('authenticate', 'LoginController@authenticate');
Route::get('logout', function () {
    Auth::logout();
    return redirect('/');
});
/*
 Topic Route
*/
Route::get('topics', 'TopicController@index');
Route::get('topics/create', 'TopicController@create');
Route::post('topics/store', 'TopicController@store');
Route::get('topics/edit/{id}', 'TopicController@edit');
Route::post('topics/update', 'TopicController@update');

/*
 Post Route
*/
Route::get('posts', 'PostController@index');
Route::get('posts/create', 'PostController@create');
Route::post('posts/store', 'PostController@store');
Route::get('posts/edit/{id}', 'PostController@edit');
Route::post('posts/update', 'PostController@update');
Route::get('posts/show/{id}', 'PostController@show');
Route::post('posts/delete', 'PostController@delete');
Route::get('posts/search', 'PostController@search');
Route::get('comments/search/{id}', 'PostController@searchComment');
/*
 Comment Route
*/
Route::get('comments/create/{id}', 'CommentController@create');
Route::post('comments/store', 'CommentController@store');
Route::get('comments/edit/{postId}/{id}', 'CommentController@edit');
Route::post('comments/update', 'CommentController@update');
Route::post('comments/delete', 'CommentController@delete');