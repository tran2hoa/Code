<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Image;
use App\Posts;
use App;
use Jenssegers\Agent\Agent;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
   

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
   
    public function upload_image(Request $request){
        $image = $request->file('image');
        $filename = time().'.'.$image->getClientOriginalExtension();
        $destinationPath = public_path('/uploads');
        $img = Image::make($image->getRealPath());
        $img->fit(520, 360, function ($constraint) {
            $constraint->upsize();
        })->save($destinationPath.'/'.$filename);
        $destinationPath = public_path('/images');
        $image->move($destinationPath, $filename);
        return json_encode('/uploads'.'/'.$filename);


    }
    public function test(){
        $agent = new Agent();
        $languages = $agent->languages();
        return $languages;
        $germany = Country::where('code', '100%')->first();
        // return $germany;
       return View('test')->withPosts($germany);
    }
}
