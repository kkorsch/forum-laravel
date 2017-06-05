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

Route::get('/activate/account/{link}', 'Auth\activationController@activate')->name('auth.activate');
Route::get('/activate/resend', 'Auth\activationController@resend')->name('auth.resend');

Route::get('/user/{user}', 'ProfileController@index')->name('profile.index');

Route::get('/ranking', 'RankingController@index')->name('ranking');

Auth::routes();

Route::group(['middleware' => 'auth'], function() {
  Route::get('/home', 'HomeController@index')->name('home');
  Route::post('/home', 'HomeController@post');

  Route::get('user/{user}/{vote}', 'VoteController@vote')->name('vote');

  Route::get('/topic/{topic}', 'TopicController@index')->name('topic.index');
  Route::post('/topic/{topic}', 'TopicController@addPost');

  Route::group(['middleware' => 'moderator'], function(){
    Route::post('/delete/topic/{topic}', 'HomeController@delete')->name('home.delete');

    Route::group(['middleware' => 'admin'], function(){
      Route::get('/admin', 'adminController@index')->name('admin.index');
      Route::post('/admin/add/moderator', 'adminController@addModerator')->name('admin.add.moderator');
      Route::post('/admin/delete/moderator', 'adminController@deleteModerator')->name('admin.delete.moderator');
      Route::post('/admin/ban', 'adminController@banUser')->name('admin.ban.user');

      Route::group(['middleware' => 'bigadmin'], function(){
        Route::post('/admin/add/admin', 'adminController@addAdmin')->name('admin.add.admin');
        Route::post('/admin/delete/admin', 'adminController@deleteAdmin')->name('admin.delete.admin');

      });
    });
  });
  Route::group(['prefix' => 'restapi'], function(){
    Route::get('/', function() {
      return view('api');
    });
    Route::get('/users', 'RestApiController@usersIndex')->name('api.users');
    Route::get('/topics', 'RestApiController@topicsIndex')->name('api.topics');
    Route::get('/topic/{topic}', 'RestApiController@topicShow')->name('api.topic');
  });


});
