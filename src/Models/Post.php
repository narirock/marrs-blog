<?php

namespace Marrs\MarrsBlog\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

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
        "restrict",
        "meta_description",
        "meta_keywords",
        "seo_title",
        "image"
    ];

    public static  function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->author_id = auth()->check() ? auth()->user()->id : null;
        });
    }

    public function category()
    {
        return $this->belongsTo('Marrs\MarrsBlog\Models\Category');
    }

    public function author()
    {
        return $this->belongsTo('Marrs\MarrsAdmin\Models\Admin', 'author_id');
    }

    public function access()
    {
        return $this->hasMany('Marrs\MarrsBlog\Models\PostRead', 'blog_post_id');
    }
}
