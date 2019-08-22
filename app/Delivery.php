<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    protected $fillable = ['city_id', 'title', 'address', 'phone', 'area', 'product_id'];

    public function city()
    {
        return $this->belongsTo('App\City');
    }

    public function product()
    {
        return $this->belongsTo('App\Product');
    }
}
