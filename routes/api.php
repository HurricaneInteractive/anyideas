<?php

use Illuminate\Http\Request;

/*
| API Routes
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
*/

// Route::get('/{any}', 'SinglePageController@index')->where('any', '.*');

Route::post('register', 'AuthController@register');
Route::post('login', 'AuthController@login');

Route::apiResource('ideas', 'IdeaController');
// Route::post('idea/{idea}');

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Auth::routes();

Route::get('/logout', function() {
    Auth::logout();
    return Redirect::to('/');
});