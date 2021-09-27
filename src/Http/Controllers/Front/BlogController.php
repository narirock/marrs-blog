<?php

namespace Marrs\MarrsBlog\Http\Controllers\Front;

use Illuminate\Http\Request;
use Marrs\MarrsBlog\Models\Post;
use Marrs\MarrsBlog\Models\PostRead;
use Marrs\MarrsBlog\Http\Controllers\Controller;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $term = $request->term;
        $type = $request->type;
        $date = date('Y-m-d');
        $tag = "";

        $notices = new Post;



        if ($term) {
            $notices = $notices->where(function ($sql) use ($term) {
                $sql->where('body', 'LIKE', '%' . $term . '%')
                    ->orwhere('title', 'LIKE', '%' . $term . '%')
                    ->orwhere('excerpt', 'LIKE', '%' . $term . '%');
            });
        }
        //se categorias forem selecionadas devem ser mostrados apenas os posts
        if ($request->category) {
            $notices = $notices->where('category_id', '=', $request->category);
        }
        //se tags forem clicadas devem ser mostrados apenas os posts
        if ($request->tag) {
            $notices = $notices->where('meta_keywords', 'LIKE', '%' . $request->tag . '%');
            $tag = $request->tag;
        }

        $posts = $notices->where('status', 'PUBLISHED')
            ->where('publish', '<=', $date)
            ->orderby('publish', 'desc')
            ->paginate(8);


        return view('marrs-blog::front.blog.index', ['posts' => $posts]);
    }

    public function post(Request $request)
    {
        $ip = @$request->ip();
        $post = Post::where('slug', $request->slug)->first();

        PostRead::create([
            'ip' => $ip,
            'blog_posts_id' => $post->id
        ]);

        //gerenciando posts relacionados
        $relateds = [];
        if ($post->meta_keywords) {
            $tags = explode(',', $post->meta_keywords);
            $relateds = new Post;
            $relateds = $relateds->where(function ($q) use ($tags) {
                foreach ($tags as $tag) {
                    $q->orwhere('meta_keywords', 'LIKE', '%' . trim($tag) . '%');
                }
            });

            $date = date('Y-m-d');
            $relateds = $relateds
                ->where('status', 'PUBLISHED')
                ->where('publish', '<=', $date)->where('id', '<>', $post->id)
                ->orderby('publish', 'desc')
                ->limit(3)
                ->get();
        }
        return view('marrs-blog::front.blog.single', [
            'post' => $post,
            'relateds' => $relateds
        ]);
    }
}
