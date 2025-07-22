<?php

namespace Theokbokki\Owns\Components;

Trait IsComponent
{
    public static function make(...$arguments): self
    {
        return new static(...$arguments);
    }
}
