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
    //user routes
    Route::post('/user/get', 'IdeasController@getUser');
    Route::post('/user/get/{id}', 'IdeasController@getUserById');

    //idea routes
    Route::post('/idea/get/all', 'IdeasController@getAll');

    Route::post('/idea/create', 'IdeasController@createIdea');
    Route::post('/idea/delete/{id}', 'IdeasController@deleteIdea');
    Route::post('/idea/update/{id}', 'IdeasController@updateIdea');

    Route::post('/idea/get/{id}', 'IdeasController@getById');
    Route::post('/idea/get-by-user/{id}', 'IdeasController@getByUser');
    Route::post('/idea/get-by-title/{title}', 'IdeasController@getByTitle');
    Route::post('/idea/get-by-category/{category}', 'IdeasController@getByCategory');
    Route::post('/idea/get-by-tags', 'IdeasController@getByTags');

    // timeline routes
    Route::post('/idea/timeline/get/{id}', 'TimelineController@getAll'); // parameter passed is idea_id
    Route::post('/idea/timeline/create/{id}', 'TimelineController@create');
    Route::post('/idea/timeline/delete/{id}', 'TimelineController@deleteEntry');
    Route::post('/idea/timeline/update/{id}', 'TimelineController@updateEntry');
    Route::post('/idea/timeline/darts/add/{id}', 'TimelineController@dartAdd');
});



Route::post('/logout', function() {
    Auth::logout();
    return Redirect::to('/');
});