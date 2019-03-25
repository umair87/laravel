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

//Route::get('/', function () {
//    return view('welcome');
//});

Auth::routes();

Route::prefix('admin')->group(function() {
    Route::get('/dashboard', 'Admin\AdminController@index')->name('adminDashboard');
    Route::post('/delete', 'Admin\AdminController@deletePost')->name('deletePost');
    Route::post('/featured', 'Admin\AdminController@makeFeaturedPost')->name('makeFeaturedPost');
    Route::post('/publish', 'Admin\AdminController@publishPost')->name('publishPost');
    Route::get('/{name}/{id}', 'Admin\AdminController@showSinglePost')->name('adminSinglePost');
});

Route::get('/post-login', 'HomeController@index');
Route::get('/story/new', 'HomeController@newStory')->name('newStory');
Route::post('/story/new', 'HomeController@postNewStory')->name('postNewStory');
Route::get('/story/new/{id}', 'HomeController@createNewStoryContent')->name('createNewStoryContent');
Route::get('/story/edit/{id}', 'HomeController@createNewStoryContent')->name('editNewStoryContent');
Route::post('/story/new/{id}', 'HomeController@postNewStoryContent')->name('postNewStoryContent');
Route::post('/story/save', 'HomeController@saveContent')->name('saveContent');

Route::get('/', 'PublicController@index')->name('home');
Route::get('/home', 'PublicController@index');
Route::get('/{name}/{id}', 'PublicController@showSinglePost')->name('singlePost');
Route::get('/{type}/{name}/{id}', 'PublicController@getTopicPosts')->name('topicPosts');
