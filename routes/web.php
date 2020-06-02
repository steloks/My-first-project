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

Route::get('/', 'PostsController@index')->name('home');

Auth::routes();

Route::post('follow/', 'FollowsController@store')->name('toggle');

Route::get('/p/create','PostsController@create');
Route::get('/p/{post}','PostsController@show');
Route::post('/p','PostsController@store');
Route::post('/comment/create','CommentsController@store')->name('posts.comment.show');
Route::post('/message/create','MessagesController@store')->name('message.show');
Route::post('/comment/delete','CommentsController@delete')->name('post.comment.delete');
Route::post('/get/comments','CommentsController@getComments')->name('get.comments');
Route::post('/get/userid','CommentsController@getUserId')->name('get.userid');
Route::post('/get/followers','FollowsController@getFollowers')->name('get.followers');
Route::post('/get/messages','MessagesController@getMessages')->name('get.messages');


Route::get('/profile/{user}', 'ProfileController@index')->name('profile.show');
Route::get('/profile/{user}/edit', 'ProfileController@edit')->name('profile.edit');
Route::patch('/profile/{user}', 'ProfileController@update')->name('profile.update');


Route::get('/test', function(){
    return view('test');
});


