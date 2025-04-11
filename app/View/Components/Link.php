<?php

namespace App\View\Components;

use App\Models\Link as LinkModel;
use App\Models\Note;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\View\Component;

class Link extends Component
{
    public Model $item;

    public string $url;

    public string $content;

    /**
     * Create a new component instance.
     */
    public function __construct(Model $item)
    {
        $this->item = $item;

        if (get_class($item) === LinkModel::class) {
            $this->url = $item->url;
            $this->content = $item->description;
        }

        if (get_class($item) === Note::class) {
            $this->url = route('note', ['note' => $item]);
            $this->content = $item->title;
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.link');
    }
}
