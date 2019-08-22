<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Dimsav\Translatable\Translatable;
class Friend extends Model
{
    use Translatable;
    public $translatedAttributes = ['title', 'desc'];
    protected $fillable = [
        'image',
        'title',
        'desc'
    ];
}
