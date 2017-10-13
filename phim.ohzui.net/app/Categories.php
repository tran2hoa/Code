<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// use Dimsav\Translatable\Translatable;


class Categories extends Model
{
	// use Translatable;
    protected $guarded = [];
	// public $translatedAttributes = ['tname','tdescription'];
 //    public $useTranslationFallback = true;

    public function posts()
    {
        return $this->belongsToMany(Posts::class,'posts_categories');
    }

}
