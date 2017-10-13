<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use \Dimsav\Translatable\Translatable;
    
    public $translatedAttributes = ['name'];
    protected $fillable = ['code'];
    
    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    // (optionaly)
    // protected $with = ['translations'];
}
