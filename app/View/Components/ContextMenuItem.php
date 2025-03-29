<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ContextMenuItem extends Component
{
    public ?string $disabled;

    public ?string $href;

    /**
     * Create a new component instance.
     */
    public function __construct(bool $disabled = false, ?string $href = null)
    {
        $this->disabled = $disabled ? 'context-menu__item--disabled' : null;

        $this->href = $href;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.context-menu-item');
    }
}
