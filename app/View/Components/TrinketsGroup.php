<?php

namespace App\View\Components;

use App\Enums\TrinketType;
use App\Models\Trinket;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\Component;

class TrinketsGroup extends Component
{
    public Collection $group;

    public string $title;

    /**
     * Create a new component instance.
     */
    public function __construct(Collection $group, string $key)
    {
        $this->group = $group;

        $this->title = TrinketType::tryFrom($key)->label();
    }

    public function src(Trinket $trinket)
    {
        return Storage::disk('public')->url($trinket->src);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.trinkets-group');
    }
}
