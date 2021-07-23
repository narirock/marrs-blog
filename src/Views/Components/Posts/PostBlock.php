<?php

namespace Marrs\MarrsBlog\Views\Components\Posts;

use Illuminate\View\Component;

class PostBlock extends Component
{
    public $post;
    public $lg;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($post, $lg = 4, $btn = '')
    {
        $this->post = $post;
        $this->lg = $lg;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('marrs-blog::components.posts.post-block', ['post' => $this->post, 'lg' => $this->lg]);
    }
}
