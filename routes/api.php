<?php

use Illuminate\Http\Request;
use App\Http\Middleware\SecureApi;

use App\Ideas;
use App\Http\Resources\Ideas as IdeasResource;
use App\Http\Resources\IdeasCollection;

use App\User;
use App\Http\Resources\User as UserResource;

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

Auth::routes();

Route::group(['prefix' => 'v1'], function() {

    Route::get('ideas.get', 'IdeasController@getAllResourceData');
    Route::get('idea.get/{id}', 'IdeasController@getResourceById');

    Route::get('feed.get', 'HomeController@getFeedData');

});