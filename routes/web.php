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
    Route::post('/idea/timeline/create/{idea_id}', 'TimelineController@create');
    Route::post('/idea/timeline/delete/{id}', 'TimelineController@deleteEntry');
    Route::post('/idea/timeline/update/{id}', 'TimelineController@updateEntry');
    Route::post('/idea/timeline/darts/add/{id}', 'TimelineController@dartAdd');

    // discussion routes
    Route::post('/idea/discussion/get/{idea_id}', 'DiscussionController@getAll'); // parameter passed is idea_id
    Route::post('/idea/discussion/create/{idea_id}', 'DiscussionController@create'); // parameter passed is idea_id
    Route::post('/idea/discussion/delete/{id}', 'DiscussionController@deleteEntry'); // pass id of discussion
    Route::post('/idea/discussion/update/{id}', 'DiscussionController@updateEntry'); // pass id of discussion

    // discussion reply routes
    Route::post('/idea/discussion/reply/get/{id}', 'DiscussionReplyController@getById'); // parameter passed is idea_id
    Route::post('/idea/discussion/reply/get/all/{idea_id}', 'DiscussionReplyController@getAllByDiscId'); // parameter passed is idea_id
    Route::post('/idea/discussion/reply/create/{idea_id}', 'DiscussionReplyController@create'); // parameter passed is idea_id
    Route::post('/idea/discussion/reply/delete/{id}', 'DiscussionReplyController@deleteEntry'); // pass id of discussion
    Route::post('/idea/discussion/reply/update/{id}', 'DiscussionReplyController@updateEntry'); // pass id of discussion
    
    // updates_post routes
    Route::post('/idea/update_post/get/{id}', 'UpdatesPostController@getById'); // parameter passed is idea_id
    Route::post('/idea/update_post/get/all/{idea_id}', 'UpdatesPostController@getAllByIdeaId'); // parameter passed is idea_id
    Route::post('/idea/update_post/create/{idea_id}', 'UpdatesPostController@create'); // parameter passed is idea_id
    Route::post('/idea/update_post/delete/{id}', 'UpdatesPostController@deleteEntry'); // pass id of discussion
    Route::post('/idea/update_post/update/{id}', 'UpdatesPostController@updateEntry'); // pass id of discussion
    Route::post('/idea/update_post/darts/add/{id}', 'UpdatesPostController@dartAdd');
    
});

Route::post('/logout', function() {
    Auth::logout();
    return Redirect::to('/');
});