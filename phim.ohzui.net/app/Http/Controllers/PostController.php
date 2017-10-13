<?php
namespace App\Http\Controllers;

use App\Posts;
use App\User;
use App\Comments;
use App\PostCategory;
use App\Categories;
use App\Http\Controllers\Controller;
use App\Http\Requests\PostFormRequest;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Jenssegers\Agent\Agent;


class PostController extends Controller
{
	

	public function index() {
		// $agent = new Agent();
		$n_post_page=8;
		// if($agent->isMobile()) $n_post_page=20;
		//fetch 10 posts from database which are active and latest
		$posts = Posts::where('active',1)->orderBy('created_at','desc')->paginate($n_post_page);
		//page heading
		$title = 'Phim Mới | Phim hay | Xem phim nhanh | Xem phim online | Phim HD vietsub hay nhất | Phim 2017';
		//return home.blade.php template from resources/views folder
        $lasted=Posts::where('active',1)->orderBy('created_at','desc')->first();
		
		if($posts)
			return view('home')->withPost($lasted)->withPosts($posts)->withTitle($title)->with('lasted',$lasted);
		else {
			return View('home')->withMessage("No Video");
		}
	}

	public function show($slug) {
		$post = Posts::where('slug',$slug)->first();
		if(!$post){
			return redirect('/')->withErrors('not found this page!');
		}
		else{
			if($post->views)
				$post->views+=1; 
			else $post->views=100;
			$post->save();
		}
		$random_posts= Posts::inRandomOrder()->take(8)->get();
		$related_posts = Posts::inRandomOrder()->take(2)->get();
		$comments=Comments::where('on_post',$post->id)->get();
		if(count($comments)){
			$comments = $post->comments;
		}
		else $comments=Null;

		$title = $post->title;
		return view('posts.show')->withPost($post)->withComments($comments)->with('ran_posts',$random_posts)->with('related_posts',$related_posts)->withTitle($title);
	}

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

            $post->save();

			// tạo category cho post
			if($request->get('category')){
				if(!PostCategory::where('post_id',$post->id)->where('category_id',$request->get('category'))->first()){
					$post_category = new PostCategory();
					$post_category->post_id=$post->id;
					$post_category->category_id=$request->get('category');
					$post_category->save();
				}
			}
			return back()->withMessage($message);
        }
        else
            return redirect('/')->withErrors('Invalid Operation. You have not sufficient permissions!');
	}

	public function destroy(Request $request, $id) { 
		$post = Posts::find($id); 
		if($post && ($post->author_id == $request->user()->id || $request->user()->is_admin())){
			$post->delete();
			$data['message'] = 'Posts deleted!';
		}
		else{
			$data['errors'] = 'Invalid Operation. You have not sufficient permissions';
		}
		return redirect('/')->with($data); 
	}

}
