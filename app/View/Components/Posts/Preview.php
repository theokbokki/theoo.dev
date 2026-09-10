<?php

namespace App\View\Components\Posts;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Intervention\Image\DataUri;

class Preview extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public DataUri $file, public string $id)
    {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.posts.preview');
    }
}
