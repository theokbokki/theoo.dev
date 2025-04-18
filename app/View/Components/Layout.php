<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Layout extends Component
{
    public ?string $title;

    public ?bool $needsJs;

    /**
     * Create a new component instance.
     */
    public function __construct(?string $title, ?bool $needsJs = false)
    {
        $this->title = 'Theoo';

        if ($title) {
            $this->title .= ' • '.$title;
        }

        $this->needsJs = $needsJs;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.layout');
    }
}
