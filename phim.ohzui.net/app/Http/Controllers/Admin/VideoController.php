<?php

namespace App\Http\Controllers\Admin;

use App\Categories;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Posts;
use App\Http\Requests\PostFormRequest;
use Illuminate\Support\Facades\File;
use App\PostCategory;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Posts::where('active',1)->orderBy('created_at','desc')->paginate(20);
        //page heading
        $title = 'Videos';

        if($posts)
            return view('admin.home')->withPosts($posts)->withTitle($title);
        else {
            return View('admin.home')->withMessage("No Video");
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request) { // if user can post i.e. user is admin or author
        if($request->user()->can_post()) {
            $categories=Categories::orderBy('created_at','asc')->get();
            return view('admin.posts.create')->with('categories',$categories);
        }
        else{
            return redirect('/')->withErrors('No permissions.');
        }
    }

    public function store(PostFormRequest $request) {
//        return $request->get('category');
        $post = new Posts();
        $post->title = $request->get('title');
        $post->body = $request->get('body');
        $post->description = $request->get('description');

        // tạo slug neu trung them -1.2... sau
        $slug = str_slug($post->title);
        $duplicate = Posts::where('slug',$slug)->first();
        $i=1;
        while($duplicate){
            $duplicate = Posts::where('slug',$slug."-".$i)->first();
            $i++;
        }
        $i--;
        if($i>0) $post->slug= $slug."-".$i; //neu trung thi them gia trị int sau
        else $post->slug= $slug;

        //nguoi tung tao bai viet
        $post->author_id = $request->user()->id;

        // source video
        if($request->get('video')){
            $post->video = $request->get('video');
        }

        // hình đại diện
        if($request->get('thumbnail')){
            $post->thumbnail = $request->get('thumbnail');
        }

        if($request->has('save')) {
            $post->active = 0;
            $message = 'Post saved successfully';
        }
        else {
            $post->active = 1;
            $message = 'Post published successfully';
        }
        $post->save();
        $locale="en";
        $post->{'ttitle:'.$locale} = $post->title;
        $post->{'tdescription:'.$locale} = $post->description;
        $post->{'tbody:'.$locale} = $post->body;
        $post->save();
        if($post->save()&&$request->get('category')){
            foreach($request->get('category') as $row) {
                $post->categories()->attach($row);
            }
        }

        return redirect('/admin/videos')->withMessage($message);
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
    public function edit(Request $request,$slug) {
        $post = Posts::where('slug',$slug)->first();
        $inCategory = array();
        foreach($post->categories as $cat){
            array_push($inCategory, $cat->name);
        }
        $categories=categories::orderBy('slug','asc')->get();

        $languages= array();
        foreach ($post->translations as $key => $value) {
            array_push($languages,  $value->locale);
        }

        if($post)
            return view('posts.edit')->with('post',$post)->with('categories',$categories)->with('inCats',$inCategory)->with('langs',$languages);
        return redirect('/')->withErrors('Invalid Operation. You have not sufficient permissions!');
    }

    public function update(Request $request,$id) {
        $post = Posts::find($id);

        // kiem tra co video
        if($post){
            $title = $request->input('title');
            $post->title = $title;
            if($request->input('thumbnail')){
                $post->thumbnail = $request->input('thumbnail');
            }
            $post->body = $request->input('body');
            $post->description = $request->input('description');
            if($request->input('video')){
                $post->video = $request->input('video');
            }
            $message = 'video updated successfully';
            if($post->save()&&$request->get('category')){
                $post->categories()->detach();
                foreach($request->get('category') as $row) {
                    $post->categories()->attach($row);
                }
            }
            return back()->withMessage($message);
        }
        else
            return redirect('/')->withErrors('Invalid Operation. You have not sufficient permissions!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Posts::find($id);
        if($post){
            $post->delete();
            $data['message'] = 'Posts deleted!';
        }
        else{
            $data['errors'] = 'Invalid Operation. You have not sufficient permissions';
        }
        return redirect('/admin')->with($data);
    }


    public function curl($url) {
        $ch = @curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        $head[] = "Connection: keep-alive";
        $head[] = "Keep-Alive: 300";
        $head[] = "Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7";
        $head[] = "Accept-Language: en-us,en;q=0.5";
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/37.0.2062.124 Safari/537.36');
        curl_setopt($ch, CURLOPT_HTTPHEADER, $head);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Expect:'));
        $page = curl_exec($ch);
        curl_close($ch);
        return $page;
    }
    public function getPhotoGoogle($link){
        $get = curl($link);
        $data = explode('url\u003d', $get);
        $url = explode('%3Dm', $data[1]);
        $decode = urldecode($url[0]);
        $count = count($data);
        $linkDownload = array();
        if($count > 4) {
            $v1080p = $decode.'=m37';
            $v720p = $decode.'=m22';
            $v360p = $decode.'=m18';
            $linkDownload['1080p'] = $v1080p;
            $linkDownload['720p'] = $v720p;
            $linkDownload['360p'] = $v360p;
        }
        if($count > 3) {
            $v720p = $decode.'=m22';
            $v360p = $decode.'=m18';
            $linkDownload['720p'] = $v720p;
            $linkDownload['360p'] = $v360p;
        }
        if($count > 2) {
            $v360p = $decode.'=m18';
            $linkDownload['360p'] = $v360p;
        }
        return $linkDownload;
    }
}
