<?php

namespace Theoo\Components;

class Header implements Component
{
    use IsComponent;

    public string $title;

    public object $img;

    public function __construct(string $title) 
    {
        $this->title = $title;
        $this->img = $this->getImg();
    }

    protected function getImg(): object
    {
        $imgs = [
            [
                'src' => asset('matcha.webp'),
                'alt' => 'The head of Matcha, my tabby cat, yawning big time.',
            ],
            [
                'src' => asset('tsuki.webp'),
                'alt' => 'The head of Tsuki, my tuxedo cat, roaring at me angrily.',
            ],
        ];

        return (object) $imgs[array_rand($imgs)];
    }

    public function render(): string
    {
        return <<<HTML
            <header class="header">
                <h1 class="header__title">{$this->title}</h1>
                <a href="/" class="header__link">
                    <span class="sro">Home</span>
                    <img class="header__img" src="{$this->img->src}" alt="{$this->img->alt}">
                </a>
            </header>
        HTML;
    }
}
