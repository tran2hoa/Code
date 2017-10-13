<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];
    protected $guarded = ['role'];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    /**
    *
    * relationship
    *
    */

    /**
    *relationship 1-1 with profile
    */
    public function profile()
    {
        return $this->hasOne('App\Profile','users_id');
    }

    /**
    *relationship n-n with course
    */
    public function courses() {
        return $this->belongsToMany('App\Course','users_courses','users_id','courses_id');
	  }

    /**
    *relationship n-n with topics
    */
    public function topics() {
        return $this->belongsToMany('App\Topic','exams_topics_users','users_id','topics_id');
	  }

    /**
    *relationship n-n with exams
    */
    public function exams() {
        return $this->belongsToMany('App\Exam','exams_topics_users','users_id','exams_id');
	  }

    /**
    * middleware role for users
    *
    */
    public function isAdmin(){
        $role = $this->role;
        if($role == 'admin'){
            return true;
        }
        return false;
    }

    public function isSuperAdmin(){
        $role = $this->role;
        if($role == 'superadmin'){
            return true;
        }
        return false;
    }

    public function isUser(){
        $role = $this->role;
        if($role == 'user'){
            return true;
        }
        return false;
    }
}
