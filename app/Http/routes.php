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
use App\Blog;
Route::get('/', function () {
    return view('welcome');
});
Route::get('/search','SearchController@searchResults');
Route::get('/user',function()
{
	return view('userpage');
});
Route::get('/userview/{user}','SearchController@viewProfile');

Route::post('blogs/{blog}/edit','BlogController@editBlog');

Route::get('blogs/{blog}','BlogController@editForm');
Route::post('/{user}/addblog','BlogController@addPost');

Route::auth();

Route::get('/home', 'HomeController@index');
Route::post('/likes','BlogController@likes');
Route::post('/follow','SearchController@follow');
Route::post('/upload','ImageController@imageupload');
Route::get('blogs/{blog}/view','BlogController@viewBlog');
Route::post('blogs/{blog}/comment','CommentController@addcomment');
//Route::post('/demo','DemoController@index');
Route::get('/demopost',function()
{
	return view('demo');
});
Route::post('/searchuser','SearchSuggest@index');