<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Dimsav\Translatable\Translatable;

class Posts extends Model { 
	 use Translatable;
	//restricts columns from modifying 
	protected $guarded = []; 
	protected $table = 'posts';

	// public $translatedAttributes = ['ttitle','tdescription','tbody'];
 //    public $useTranslationFallback = true;

	// posts has many comments 
	// returns all comments on that post 
	public function comments() { 
		return $this->hasMany(Comments::class,'on_post','id'); 
	} 
	public function categories() {
        return $this->belongsToMany(Categories::class,'posts_categories');
	} 
		//returns the instance of the user who is author of that post 
	public function author() { 
		return $this->belongsTo(User::class,'author_id'); 
	}
	  // public function translations()
   //  {
   //      return $this->hasMany(PostsTranslation::class,'posts_id','id');  
   //  }

}