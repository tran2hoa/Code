<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $table = 'profiles';

    protected $fillable = [
        'birthday', 'person_id', 'birthplace', 'phone', 'address', 'student_class', 'student_code', 'type',
    ];

    /**
    *
    * relationship
    *
    */

    /**
    *relationship 1-1 with user
    */
    public function user()
    {
        return $this->belongsTo('App\User', 'users_id');
    }
}
