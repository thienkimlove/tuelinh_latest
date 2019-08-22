<?php

namespace App;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use Translatable;

    public $timestamps = false;

    public $translatedAttributes = ['title', 'seo_title'];

    protected $fillable = ['parent_id', 'title', 'slug', 'seo_title'];

    /**
     * category have many posts.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posts()
    {
        return $this->hasMany('App\Post')->where('status', true);
    }
    /**
     * parent of this category
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parent()
    {
        return $this->belongsTo('App\Category', 'parent_id', 'id');
    }

    /**
     * sub of this category
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function subCategories()
    {
        return $this->hasMany('App\Category', 'parent_id', 'id');

    }
    public function getHomepageAttribute()
    {
        return $this->posts()->latest('updated_at')->limit(8)->get();
    }

    public function getPaginateAttribute()
    {
        return $this->posts()->latest('updated_at')->paginate(8);
    }
}
