<?php

namespace Marrs\MarrsBlog\Models;

use Illuminate\Database\Eloquent\Model;

class PostRead extends Model
{
    protected $table = "blog_post_reads";

    protected $fillable = ['blog_posts_id', 'ip'];

    public function posts()
    {
        return $this->belongsTo(Post::class);
    }
}
