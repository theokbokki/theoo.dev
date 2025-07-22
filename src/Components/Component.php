<?php

namespace Theoo\Components;

Interface Component
{
    public function render(): string;

    public static function make(...$arguments): self;
}
