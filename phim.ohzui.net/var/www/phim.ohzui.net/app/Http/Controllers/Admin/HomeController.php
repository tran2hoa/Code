<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Posts;

class HomeController extends Controller
{
    public function index() {
        //fetch 10 posts from database which are active and latest
        $posts = Posts::where('active',1)->orderBy('created_at','desc')->paginate(20);
        //page heading
        $title = 'Videos';
        //return home.blade.php template from resources/views folder
        if($posts)
            return view('admin.home')->withPosts($posts)->withTitle($title);
        else {
            return View('admin.home')->withMessage("No Video");
        }
    }
}
