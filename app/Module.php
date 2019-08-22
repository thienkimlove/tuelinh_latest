<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'slug', 'post_id', 'order'
    ];
}
