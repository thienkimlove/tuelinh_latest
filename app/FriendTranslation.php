<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FriendTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = ['title','locale', 'friend_id', 'desc'];
}