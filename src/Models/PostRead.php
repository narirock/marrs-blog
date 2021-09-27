<?php

namespace Marrs\MarrsBlog\Models;

use Illuminate\Database\Eloquent\Model;

class PostRead extends Model
{
    protected $table = "blog_post_reads";

    protected $fillable = ['blog_post_id', 'ip'];

    public function posts()
    {
        return $this->belongsTo(Post::class);
    }
}
