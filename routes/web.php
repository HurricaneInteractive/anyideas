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



Route::get('/{any}', 'SinglePageController@index')->where('any', '.*');

Auth::routes();

Route::get('/logout', function() {
    Auth::logout();
    return Redirect::to('/');
});
// Auth::get('logout', 'LoginController@logout');

// Route::get('/', function () {
//     return view('index');
// });

// Route::get('/test', function() {
//     return view('test');
// });

// Route::get('/test/{name}', 'Test@show');

// Route::get('/home', 'HomeController@index')->name('home');
