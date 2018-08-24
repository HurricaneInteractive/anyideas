<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// CURD - Create / Update / Retrieve / Destroy


// user routes
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// idea routes
Route::get('/idea/all/get', 'IdeasController@getAll');

Route::post('/idea/create', 'IdeasController@createIdea');
Route::post('/idea/{id}/delete', 'IdeasController@deleteIdea');
Route::post('/idea/{id}/update', 'IdeasController@updateIdea');

Route::get('/idea/{id}/get', 'IdeasController@getById');
Route::get('/idea/{title}/get', 'IdeasController@getByTitle');
Route::get('/idea/{category}/get', 'IdeasController@getByCategory'); // should be an array[]
Route::get('/idea/{tags}/get', 'IdeasController@getByTags'); // should be an array[]
Route::get('/idea/{title}/get-by-title', 'IdeasController@getByTitle');

// timeline routes
Route::get('/idea/timeline/{idea_id}/get', 'TimelineController@getAll');