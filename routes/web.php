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


Auth::routes(['register' => false]);
Route::post('register', 'UserController@store');

Route::get('/', 'BlogController@index')->name('blogs.index');

Route::get('/{slug}', 'BlogController@show')->where('slug', '^((?!admin).)*$')->name('blogs.show');

Route::group(['middleware' => ['auth','role:administrator'], 'prefix' => 'admin'], function () 
{
    Route::get('/', 'PostController@index')->name('post.index');
    Route::resource('posts', 'PostController', ['except' => 'show']);
	Route::get('/posts/{id}/{slug}', 'PostController@show')->name('posts.show');

 	/** Select2 AJAX queries **/
 	Route::get('tags', array('uses' => 'PostController@getTags'));

});




