<?php

namespace App\Http\Controllers\Admin;

use App\Posts;
use App\Categories;
use App\CategoriesTranslation;
use Illuminate\Http\Request;
use App;
use App\Http\Controllers\Controller;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Categories::orderBy('created_at','asc')->paginate(10);
//        return $categories;
        $title="Categories";
        return view('admin.categories.home')->withPosts($categories)->withTitle($title);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if($request->user()->can_post()) {
            $categories=Categories::all();
            return view('categories.create')->withPosts($categories);
        }
        else{
            return redirect('/')->withErrors('No permissions.');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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
        $i--;
        if($i>0) $category->slug= $slug."-".$i; //neu trung thi them gia trị int sau
        else $category->slug= $slug;

        $category->description = $request->get('description');

//        create language default 'en'
        if($category->save()){
            $message="success";

            // $locale="en";
            // $category->{'tname:'.$locale} = $category->name;
            // $category->{'tdescription:'.$locale} = $category->description;
            // $category->save();
        }
        else $message="error";


        return back()->withMessage($message);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Categories::find($id);
        if($category != null){
            $category->delete();
            $message="deleted";
        }
        else $message="not delete";

        return back()->withMessage($message);

    }
}
