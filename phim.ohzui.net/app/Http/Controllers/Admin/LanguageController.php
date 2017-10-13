<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Posts;


class LanguageController extends Controller
{
    public function addPostLanguage(Request $request){
        $post_id = $request->input('post_id');
        $locale=$request->input('locale');
        $title=$request->input('title');
        $description=$request->input('description');
        $body=$request->input('body');

        $post = Posts::find($post_id);

        $post->{'ttitle:'.$locale} = $title;
        $post->{'tdescription:'.$locale} = $description;
        $post->{'tbody:'.$locale} = $body;
        $post->save();
        return back();
    }
    public function updatePostLanguage(Request $request){
        $post_id = $request->input('post_id');
        $locale=$request->input('locale');
        $title=$request->input('title');
        $description=$request->input('description');
        $body=$request->input('body');

        $post = Posts::find($post_id);

        $post->{'ttitle:'.$locale} = $title;
        $post->{'tdescription:'.$locale} = $description;
        $post->{'tbody:'.$locale} = $body;
        $post->save();
        return back();
    }
}
