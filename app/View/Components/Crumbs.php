<?php

namespace App\View\Components;

use App\Models\Page;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\View\Component;

class Crumbs extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public Page $page,
        public Collection $crumbs,
    ){}

    public function crumbs(): Collection
    {
        $crumbs = collect();

        for ($parent = $this->page->parent; $parent; $parent = $parent->parent) {
            $crumbs->unshift($parent);
        }

        return $crumbs;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.crumbs');
    }
}
