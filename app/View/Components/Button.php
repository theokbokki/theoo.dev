<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\View\ComponentAttributeBag;

class Button extends Component
{
    public ?string $modifiers;

    public string $tag;

    public ?string $href;

    public ?string $type;

    public ?string $icon;

    public bool $disabled;

    /**
     * Create a new component instance.
     */
    public function __construct(
        ?string $modifiers = null,
        ?string $href = null,
        ?string $type = null,
        ?string $icon = null,
        bool $disabled = false,
    ) {
        $this->modifiers = $modifiers;
        $this->href = $href;
        $this->type = $type;
        $this->icon = $icon;
        $this->disabled = $disabled;

        if ($this->href) {
            $this->tag = 'a';
            $this->type = null;
            $this->disabled = false;
        } else {
            $this->tag = 'button';
            $this->type = in_array($type, ['button', 'submit', 'reset']) ? $type : 'button';
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.button');
    }

    /**
     * Get the correct attributes in the attribute bag.
     */
    public function contextualizedAttributes(ComponentAttributeBag $attributes): ComponentAttributeBag
    {
        $modifiers = '';

        if ($this->modifiers) {
            $modifiers = explode(' ', $this->modifiers);
            $modifiers = array_map(fn($modifier) => 'button--' . $modifier, $modifiers);
            $modifiers = implode(' ', $modifiers);
        }

        $attributes = $attributes->merge(['class' => 'button ' . $modifiers]);

        if ($this->href) {
            $attributes = $attributes->merge(['href' => $this->href]);
        }

        if ($this->disabled) {
            $attributes = $attributes->merge(['disabled' => '']);
        }

        if ($this->type) {
            $attributes = $attributes->merge(['type' => $this->type]);
        }

        return $this->attributes = $attributes;
    }
}
