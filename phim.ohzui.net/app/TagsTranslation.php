<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TagsTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'tname',
    ];
}
