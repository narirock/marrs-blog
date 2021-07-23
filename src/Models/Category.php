<?php

namespace Marrs\MarrsBlog\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;

    protected $table = "blog_categories";

    protected $fillable = [
        "name",
        "description",
        "slug",
        "image",
        "enable",
        "category_id",
        "excluder_id",
        "author_id",
        "layout_id"
    ];

    public static  function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->author_id = auth()->check() ? auth()->user()->id : null;
        });

        static::deleting(function ($model) {
            $model->excluder_id = auth()->check() ? auth()->user()->id : null;
            $model->save();
        });
    }

    public function category()
    {
        return $this->belongsTo("Marrs\MarrsBlog\Models\Category");
    }

    public function posts()
    {
        return $this->hasMany("Marrs\MarrsBlog\Models\Post");
    }
}
