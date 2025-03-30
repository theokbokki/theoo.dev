<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class NavItem extends Component
{
    public string $href;

    public ?string $active;

    /**
     * Create a new component instance.
     */
    public function __construct(string $href) {
        $this->href = $href;

        $this->active = (url()->current() === $this->href)
            ? 'nav__item--active'
            : null;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.nav-item');
    }
}
