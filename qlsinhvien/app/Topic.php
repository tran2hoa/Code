<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    protected $table = 'topics';

    protected $fillable = [
        'name','description','test',
    ];

    /**
    *
    * relationship
    *
    */

    /**
    *relationship n-n with exams in exams_topics_rooms
    */
    public function exams() {
        return $this->belongsToMany('App\Exam','exams_topics_rooms','topics_id','exams_id');
    }

    /**
    *relationship n-n with users in exams_topics_users
    */
    public function users() {
        return $this->belongsToMany('App\User','exams_topics_users','topics_id','users_id');
    }

    /**
    *relationship n-n with rooms in exams_topics_rooms
    */
    public function rooms() {
        return $this->belongsToMany('App\Room','exams_topics_rooms','topics_id','rooms_id');
    }
}
