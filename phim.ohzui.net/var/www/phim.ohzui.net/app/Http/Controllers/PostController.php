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
		$agent = new Agent();
		$n_post_page=40;
		if($agent->isMobile()) $n_post_page=20;
		//fetch 10 posts from database which are active and latest
		$posts = Posts::where('active',1)->orderBy('created_at','desc')->paginate($n_post_page);
		//page heading
		$title = 'LATEST VIDEOS';
		//return home.blade.php template from resources/views folder
		if($posts)
			return view('home')->withPosts($posts)->withTitle($title);
		else {
			return View('home')->withMessage("No Video");
		}
	}
	public function showInCategory($slug) {
		//fetch 5 posts from database which are active and latest
		$n_post_page=40;
		$agent = new Agent();
		if($agent->isMobile()) $n_post_page=20;
		$posts = Categories::where('slug',$slug)->first()->Posts()->paginate($n_post_page);
        $title = 'VIDEOS';
        //return home.blade.php template from resources/views folder
        if($posts)
            return view('home')->withPosts($posts)->withTitle($title);
        else {
            return View('home')->withMessage("No Video");
        }
	}

	public function create(Request $request) { // if user can post i.e. user is admin or author
		if($request->user()->can_post()) { 
			return view('posts.create');
		}
		else{
			return redirect('/')->withErrors('No permissions.');
		}
	}

	public function store(PostFormRequest $request) { 
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
        if($i>1) $post->slug= $slug."-".$i; //neu trung thi them gia trị int sau
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

		// tạo category cho post
		if($request->get('category')){
			$post_category = new PostCategory();
			$post_category->post_id=$post->id;
			$post_category->category_id=$request->get('category');
			$post_category->save();
		}
		return redirect('edit/'.$post->slug)->withMessage($message);
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
		return view('posts.show')->withPost($post)->withComments($comments)->with('ran_posts',$random_posts)->with('related_posts',$related_posts);
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
	 public function addLanguage(Request $request){
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
    public function updateLanguage(Request $request){
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
