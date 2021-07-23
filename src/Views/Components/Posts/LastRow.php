<?php

namespace Marrs\MarrsBlog\Views\Components\Posts;

use Marrs\MarrsBlog\Models\Post;
use Illuminate\View\Component;

class LastRow extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('marrs-blog::components.posts.last-row', ['posts' => Post::with('category')->orderby('created_at', 'desc')->limit(3)->get()]);
    }
}
