<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $table = 'rooms';

    protected $fillable = [
        'name',
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
        return $this->belongsToMany('App\Exam','exams_topics_rooms','rooms_id','exams_id');
    }

    /**
    *relationship n-n with topics in exams_topics_rooms
    */
    public function topics() {
        return $this->belongsToMany('App\Topic','exams_topics_rooms','rooms_id','topics_id');
    }
}
