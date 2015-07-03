<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', [
    'as' => 'home', 'uses' => 'HomeController@index'
    ]);

Route::get('/t/{id}', 'ThreadController@shortlink');

Route::group(['prefix' => 'hashtag'], function()
{
    Route::get('/', [
    'as' => 'hashtags', 'uses' => 'TagController@index'
    ]);

    Route::get('{id}', [
    'as' => 'hashtags.view', 'uses' => 'TagController@show'
    ]);
});

Route::group(['prefix' => 'threads'], function()
{
    Route::get('/', [
        'as' => 'threads', 'uses' => 'ThreadController@index'
        ]);

        Route::get('new', [
        'as' => 'threads.create', 'uses' => 'ThreadController@create'
        ]);

        Route::get('hash/{id}', [
        'as' => 'threads.view', 'uses' => 'ThreadController@show'
        ]);

        Route::post('new/post', [
        'as' => 'threads.createpost', 'uses' => 'ThreadController@store'
        ]);

        Route::post('{id}/comment/add', [
        'as' => 'threads.createcomment', 'uses' => 'ThreadController@commentstore'
        ]);
});

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
