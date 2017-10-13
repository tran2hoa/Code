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

// Route::get('/','PostController@index');
// Route::get('/home',['as' => 'home', 'uses' => 'PostController@index']);

Auth::routes();


Route::group(['prefix'=>'admin','middleware' => ['auth']], function(){
    Route::resource('/','Admin\HomeController');
//    Route::resource('videos','PostController');

    Route::resource('categories','Admin\CategoryController');
    Route::get('categories/delete/{id}','Admin\CategoryController@destroy');

    Route::resource('videos','Admin\VideoController');
    Route::get('videos/delete/{id}','Admin\VideoController@destroy');

    Route::post('videos/{id}','PostController@update')->where('id', '[0-9]+');
    Route::post('videos/languages','Admin\LanguageController@addPostLanguage');
    Route::post('videos/languages/edit','Admin\LanguageController@updatePostLanguage');
});

Route::group(['middleware' => ['auth']], function()
{
	Route::group(['prefix'=>'/api/v1'], function(){
	 	Route::get('get-categories','CategoryController@getCategories');
	});
	// delete post
	Route::get('delete/{id}','PostController@destroy');
	// display user's all posts
	Route::get('my-all-posts','UserController@user_posts_all');
	// display user's drafts
	Route::get('my-drafts','UserController@user_posts_draft');
	// add comment
	Route::post('comment/add','CommentController@store');
	// delete comment
	Route::post('comment/delete/{id}','CommentController@destroy');
	  // add category
	Route::get('get-categories','CategoryController@getIndex');
	Route::post('category/add','CategoryController@store');
	Route::get('new-category','CategoryController@create');
	Route::get('edit-category/{id}','CategoryController@edit');
	Route::post('edit-category','CategoryController@update');
	Route::post('languages','CategoryController@addLanguage');

	// delete category
	Route::post('category/delete/{id}','CategoryController@destroy');
	Route::get('getYoutube','YoutubeController@getYoutube');
	Route::get('getPhim','YoutubeController@getPhim');
	Route::post('/upload-image','HomeController@upload_image');
});

//users profile
Route::get('user/{id}','UserController@profile')->where('id', '[0-9]+');
// display list of posts
Route::get('user/{id}/posts','UserController@user_posts')->where('id', '[0-9]+');
// display single post
// Route::get('/{slug}',['as' => 'post', 'uses' => 'PostController@show'])->where('slug', '[A-Za-z0-9-_]+');
Route::get('category/{slug}',['as' => 'post', 'uses' => 'PostController@showInCategory'])->where('slug', '[A-Za-z0-9-_]+');
Route::get('/sitemap.xml', 'SitemapController@index');
Route::get('/sitemap/videos/{lang}', 'SitemapController@posts');
Route::get('/sitemap/categories/{lang}', 'SitemapController@categories')->where('lang', '[A-Za-z_]+');



	
Route::get('/{slug}',['as' => 'post', 'uses' => 'PostController@show'])->where('slug', '[A-Za-z0-9-_]+');
Route::get('category/{slug}',['as' => 'post', 'uses' => 'CategoryController@index'])->where('slug', '[A-Za-z0-9-_]+');
Route::get('/','PostController@index');
Route::get('/home',['as' => 'home', 'uses' => 'PostController@index']);

