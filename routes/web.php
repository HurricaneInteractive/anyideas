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

Auth::routes();

Route::get('/{any}', 'SinglePageController@index')->where('any', '.*');

Route::group(['prefix' => 'ai/'], function() {
    Route::post('/idea/get/all', 'IdeasController@getAll');
    Route::post('/user/get', 'IdeasController@getUser');

    Route::post('/idea/create', 'IdeasController@createIdea');
    Route::post('/idea/delete/{id}', 'IdeasController@deleteIdea');
    Route::post('/idea/update/{id}', 'IdeasController@updateIdea');

    Route::post('/idea/get/{id}', 'IdeasController@getById');
    Route::post('/idea/get-by-user/{id}', 'IdeasController@getByUser');
    Route::post('/idea/get-by-title/{title}', 'IdeasController@getByTitle');
    Route::post('/idea/get-by-category/{category}', 'IdeasController@getByCategory');
    Route::post('/idea/get-by-tags', 'IdeasController@getByTags');
});

// timeline routes
Route::post('/idea/timeline/{idea_id}/get', 'TimelineController@getAll');

Route::post('/logout', function() {
    Auth::logout();
    return Redirect::to('/');
});