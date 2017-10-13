<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Posts;
use App\Categories;
use App;
use LaravelLocalization;


class SitemapController extends Controller
{

    public function index()
	{
		$post = Posts::orderBy('updated_at', 'desc')->first();
		$cat=Categories::orderBy('updated_at', 'desc')->first();
	  // $post = Categories::all();
	  return response()->view('sitemap.index', [
	      'post' => $post,
	      'cat'=>$cat,
	  ])->header('Content-Type', 'text/xml');
	}
	public function posts($lang)
	{
		LaravelLocalization::setLocale($lang);
	    $posts = Posts::orderBy('updated_at', 'desc')->get();
	    return response()->view('sitemap.posts', [
	        'posts' => $posts,
	    ])->header('Content-Type', 'text/xml');
	}

	public function categories($lang)
	{
		LaravelLocalization::setLocale($lang);
	    $categories = Categories::orderBy('updated_at', 'asc')->get();
	    return response()->view('sitemap.categories', [
	        'categories' => $categories,
	    ])->header('Content-Type', 'text/xml');
	}

	
}
