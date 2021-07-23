<?php

namespace Marrs\MarrsBlog\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = "blog_posts";

    protected $fillable = [
        "title",
        "body",
        "excerpt",
        "slug",
        "status",
        "publish",
        "category_id",
        "featured",
        "meta_description",
        "meta_keywords",
        "seo_title",
        "image"
    ];

    public static  function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->author_id = auth()->user()->id;
        });
    }

    public function category()
    {
        return $this->belongsTo('Marrs\MarrsBlog\Models\Category');
    }

    public function author()
    {
        return $this->belongsTo('App\Models\User', 'author_id');
    }

    public function access()
    {
        return $this->hasMany('App\Models\PostRead', 'post_id');
    }
}
