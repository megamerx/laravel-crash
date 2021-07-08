<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Post as PostModel;

class Post extends Component
{
    private $post;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(PostModel $post)
    {
        $this->post = $post;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.post', [
            'post' => $this->post
        ]);
    }
}
