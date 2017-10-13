<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    protected $table = 'exams';

    protected $fillable = [
        'name', 'description', 'start_at', 'register_start_date','register_end_date'
    ];

    /**
    *
    * relationship
    *
    */

    /**
    *relationship n-n with topics in exams_topics_rooms
    */
    public function topics() {
        return $this->belongsToMany('App\Topic','exams_topics_rooms','exams_id','topics_id');
	  }

    /**
    *relationship n-n with topics in exams_topics_users
    */
    public function users() {
        return $this->belongsToMany('App\User','exams_topics_users','exams_id','users_id');
	  }
}
