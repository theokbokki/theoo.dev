<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Layout extends Component
{
    public bool $showHeader;

    /**
     * Create a new component instance.
     */
    public function __construct(bool $showHeader = false)
    {
        $this->showHeader = $showHeader;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.layout');
    }
}
