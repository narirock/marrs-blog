<?php

namespace Marrs\MarrsBlog\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Marrs\MarrsBlog\Models\Category;

class CategoryController extends Controller
{

    private $category;

    private $extensions = [
        "jpg",
        "JPG",
        "jpeg",
        "JPEG",
        "png",
        "PNG"
    ];

    public function __construct(
        Category $category
    ) {
        $this->category = $category;
    }
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $categories = $this->category->get();
        return view('marrs-blog::admin.cruds.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $categories = $this->listnotself();
        return view('marrs-blog::admin.cruds.categories.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {

        $category = $this->category->create([
            "name"          => $request->name,
            "description"   => $request->description,
            "slug"          => $request->slug,
            "image"         => $request->image,
            "category_id"   => $request->category_id,
            "enable"        => $request->enable == '1' ? true : false
        ]);

        if ($request->image) {
            $image = $this->uploadfile($request->image);
            $category->update([
                'image' => $image
            ]);
        }

        return redirect()->route('categories.index');
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show($id)
    {
        $category = $this->category->find($id);
        return view('marrs-blog::admin.cruds.categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit($id)
    {

        $category = $this->category->find($id);
        $categories = $this->listnotself($id);
        return view('marrs-blog::admin.cruds.categories.edit', compact('category', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update($id, Request $request)
    {
        $category = $this->category->find($id);

        $category->update([
            "name"          => $request->name,
            "description"   => $request->description,
            "slug"          => $request->slug,
            "image"         => $request->image,
            "category_id"   => $request->category_id,
            "enable"        => $request->enable == '1' ? true : false
        ]);

        if ($request->image) {
            $image = $this->uploadfile($request->image);
            $category->update([
                'image' => $image
            ]);
        }

        return redirect()->route('categories.index');
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy($id)
    {
        $this->category->find($id)->delete();
        return redirect()->route('categories.index');
    }

    public function listnotself($id = null)
    {
        $categories = $this->category->where('id', '<>', $id)->orderby('name')->pluck("name", "id");
        $categories->prepend('Nenhuma');
        return $categories;
    }

    public function uploadfile($file)
    {
        $destinationPath = 'storage/uploads/' . auth()->user()->id . '/categories/';
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
