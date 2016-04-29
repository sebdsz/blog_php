<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|

|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => 'web'], function () {
    Route::auth();
    Route::pattern('id', '[0-9]+');
    Route::get('/', 'FrontController@index');
    Route::get('article/{id}', 'FrontController@show');
    Route::get('categorie/{id?}', 'FrontController@showPostByCat');
    Route::post('article/{post}/score', 'FrontController@setScorePost');
//    Route::get('user/{id}/posts', 'FrontController@showPostByUser');

    Route::group(['middleware' => ['auth.admin']], function() {
        route::resource('dashboard', 'PostController');
        route::get('dashboard/published/{post}', 'PostController@published');
    });
});
