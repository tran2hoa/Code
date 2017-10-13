<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoriesTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'tname', 'tdescription',
    ];

    public function category(){ 
		return $this->belongsTo(Categories::class,'categories_id'); 
	}
}
