<?php

namespace Theoo\Components;

Trait IsComponent
{
    public static function make(...$arguments): self
    {
        return new static(...$arguments);
    }
}
