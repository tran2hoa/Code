<?php

namespace App\Http\Controllers;

use App\Posts;
use App\Categories;
use App\CategoriesTranslation;
use Illuminate\Http\Request;
use App;

class CategoryController extends Controller
{

    public function getCategories()
    {
        $categories = Categories::all();
        return $categories; 
    }

    public function index($slug) {
        //fetch 5 posts from database which are active and latest
        $n_post_page=40;
       
        $posts = Categories::where('slug',$slug)->first()->Posts()->paginate($n_post_page);
        $title = 'VIDEOS';
        //return home.blade.php template from resources/views folder
        if($posts)
            return view('home')->withPosts($posts)->withTitle($title);
        else {
            return View('home')->withMessage("No Video");
        }
    }
   
    public function create(Request $request) { 
        if($request->user()->can_post()) {
            $categories=Categories::all();
            return view('categories.create')->withPosts($categories);
        }
        else{
            return redirect('/')->withErrors('No permissions.');
        }
    }

   public function store(Request $request)
    {
        $category = new Categories();
        $category->name = $request->get('name');

        $slug = str_slug($category->name,"-");
        $duplicate = Categories::where('slug',$slug)->first();
        $i=1;
        while($duplicate){
              $duplicate = Categories::where('slug',$slug."-".$i)->first();
              $i++;
        }
        if($i>1) $category->slug= $slug."-".$i; //neu trung thi them gia trị int sau
        else $category->slug= $slug;

        $category->description = "";
        $category->save();
        return $category;
    }

  
    public function show($id)
    {
        
    }

    
    public function edit($id)
    {
        $category = Categories::find($id);
        $languages= array();
        foreach ($category->translations as $key => $value) {
            array_push($languages,  $value->locale);
        }
        if($category)
            return view('categories.edit')->with('post',$category)->with('langs',$languages);
        return redirect('/')->withErrors('Invalid Operation. You have not sufficient permissions!');
    }
    public function update(Request $request)
    {
        $category_id = $request->input('category_id');
        $category = Categories::find($category_id);
        if($category){
            $name = $request->input('name');
            $category->name = $name;
            $category->description = $request->input('description');
            $category->save();
            $message="Update success";
            return back()->withMessage($message);
        }
        else
            return redirect('/')->withErrors('Invalid Operation. You have not sufficient permissions!');
    }

    public function addLanguage(Request $request){
        $category_id = $request->input('category_id');
        $locale=$request->input('locale');
        $name=$request->input('name');
        $description=$request->input('description');
        $category = Categories::find($category_id);

        $category->{'tname:'.$locale} = $name;
        $category->{'tdescription:'.$locale} = $description;
        $category->save();
        return back();
    }

}
