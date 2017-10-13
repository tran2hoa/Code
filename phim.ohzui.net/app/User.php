<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;


class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','role'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    // user has many posts 
    public function posts(){ 
        return $this->hasMany(Posts::class,'author_id','id'); 
    } 
    // user has many comments 

    public function comments(){ 
        return $this->hasMany(Comments::class,'from_user','id'); 
    } 

    public function can_post(){ 
        $role = $this->role; 
        if($role == 'author' || $role == 'admin'){ 
            return true; 
        } 
        return false; 
    }

    //chechk if admin
    public function isAdmin(){
        $role = $this->role; 
        if($role == 'admin'){ 
            return true; 
        } 
        return false; 
    } 

    //chechk if author
    public function isAuthor(){
        $role = $this->role; 
        if($role == 'author'){ 
            return true; 
        } 
        return false; 
    } 

     //chechk if subcriber
    public function isSubcriber(){ 
        $role = $this->role; 
        if($role == 'subcriber'){ 
            return true; 
        } 
        return false; 
    }
}
