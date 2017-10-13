<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $table = 'courses';

    protected $fillable = [
        'name', 'description', 'start_at', 'end_at',
    ];

    /**
    *
    * relationship
    *
    */

    /**
    *relationship n-n with course
    */
    public function users() {
        return $this->belongsToMany('App\User','users_courses','courses_id','users_id');
	  }

    /**
    *relationship n-1 with topic
    */
    public function topic(){
        return $this->belongsTo('App\Topic','topics_id');
    }


}
