<?php

namespace Marrs\MarrsBlog\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Marrs\MarrsBlog\Models\Category;
use Marrs\MarrsBlog\Models\Post;
use Marrs\MarrsBlog\Http\Requests\PostRequest;

class PostController extends Controller
{
    private $post;
    private $category;
    private $status = [
        'PUBLISHED' => 'PUBLICADO',
        'DRAFT'     => 'RASCUNHO',
        'PENDING'   => 'PENDENTE'
    ];

    private $extensions = [
        "jpg",
        "JPG",
        "jpeg",
        "JPEG",
        "png",
        "PNG"
    ];

    public function __construct(
        Post $post,
        Category $category
    ) {
        $this->post = $post;
        $this->category = $category;
    }

    public function index(Request $request)
    {

        $posts = $this->post->with(['author']);

        if ($request->term != "") {
            $posts = $posts->where('title', 'LIKE',  '%' . $request->term . '%');
        }

        if ($request->order) {
            $posts = $posts->orderby($request->order);
        } else {
            $posts = $posts->orderby('created_at');
        }

        if ($request->show > 0) {
            $posts = $posts->paginate($request->show);
        } else {
            $posts = $posts->paginate(10);
        }



        $term = $request->term ? $request->term : '';
        $show = $request->show ? $request->show : 10;
        $order = $request->order ? $request->order : 'created_at';

        $status = $this->status;
        return view('marrs-blog::admin.cruds.posts.index', compact('posts', 'status', 'show', 'term', 'order'));

        //$posts = $this->post->all();
        //return view('marrs-blog::admin.cruds.posts.index', compact('posts'));
    }

    public function create()
    {
        $categories = $this->category->pluck("name", "id");
        $status = $this->status;
        return view('marrs-blog::admin.cruds.posts.create', compact('categories', 'status'));
    }

    public function store(PostRequest $request)
    {

        if ($request->image) {
            $destaque = $this->uploadfile($request->image);
        }



        $this->post->create([
            "title"     => $request->title,
            "body"      => $request->body,
            "excerpt"   => $request->excerpt,
            "slug"      => $request->slug,
            "status"    => $request->status,
            "publish"    => $request->publish,
            "category_id" => $request->category_id,
            "featured" => $request->featured == 1 ? true : false,
            "restrict" => $request->restrict == 1 ? true : false,
            "meta_description" => $request->meta_description,
            "meta_keywords" => $request->meta_keywords,
            "seo_title" => $request->seo_title,
            "image"     => @$destaque,
            "image_label" => $request->image_label,

        ]);

        return redirect()->route('admin.blog.posts.index');
    }

    public function edit($id)
    {
        $post = $this->post->find($id);

        $categories = $this->category->pluck("name", "id");
        $status = $this->status;

        return view('marrs-blog::admin.cruds.posts.edit', compact('post', 'categories', 'status'));
    }

    public function update($id, PostRequest $request)
    {
        $post = $this->post->find($id);
        $post->update([
            "title"     => $request->title,
            "body"      => $request->body,
            "excerpt"   => $request->excerpt,
            "slug"      => $request->slug,
            "status"    => $request->status,
            "publish"    => $request->publish,
            "category_id" => $request->category_id,
            "featured" => $request->featured == 1 ? true : false,
            "restrict" => $request->restrict == 1 ? true : false,
            "meta_description" => $request->meta_description,
            "meta_keywords" => $request->meta_keywords,
            "seo_title" => $request->seo_title,
            "image_label" => $request->image_label,
        ]);

        if ($request->image) {
            $destaque = $this->uploadfile($request->image);
            $post->image = $destaque;
            $post->save();
        }

        return redirect()->route('admin.blog.posts.index');
    }

    public function destroy($id)
    {
        $this->post->find($id)->delete();
        return redirect()->route('admin.blog.posts.index');
    }

    public function uploadfile($file)
    {
        $destinationPath = 'storage/uploads/blog/posts/';
        if (in_array($file->extension(), $this->extensions)) {
            $size  = $file->getSize();
            $narq = explode(".", $file->getClientOriginalName());
            $extension = $file->getClientOriginalExtension();
            $fileName = date('Ymd_his') . rand(0, 100000) . '.' . $extension;
            $archive = $destinationPath . $fileName;
            $file->move($destinationPath, $archive);
            return $archive;
        } else {
            return null;
        }
    }
}
