<?php

namespace Theokbokki\Owns\Components;

Interface Component
{
    public function render(): string;

    public static function make(...$arguments): self;
}
