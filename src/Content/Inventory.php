<?php

namespace Theoo\Content;

class Inventory
{
    static function get(): array
    {
        return [
            static::addItem(
                'Orange miffy book', 
                'le-monde-de-miffy',
                'An orange Miffy book with at the center, Miffy playing with a beach ball in her blue dress and at the top the title &quot;Le monde de miffy&quot; written in orange'
            ),
            static::addItem(
                'Clear casio watch', 
                'clear-casio',
                'A casio digital watch with a clear bracelet and a white watch face'
            ),
            static::addItem(
                'Green iphone 11', 
                'iphone-11',
                'A front facing green iphone 11'
            ),
            static::addItem(
                'Nintendo Switch 2', 
                'nintendo-switch-2',
                'A Nintendo Switch 2 with the game Mario Kart world'
            ),
            static::addItem(
                'Green armchair', 
                'green-armchair',
                'A bright green armchair from IKEA. It\'s rounded and plush with a metal feet'
            ),
            static::addItem(
                'Red armchair', 
                'red-armchair',
                'A bright red armchair from IKEA. It\'s got wooden armrests that extend as a base'
            ),
            static::addItem(
                'Nike shoes with green swoosh', 
                'nike-green-swoosh',
                'A pair of white Nike shoes with green swoosh and sole'
            ),
            static::addItem(
                'Green Imac + keyboard and mouse', 
                'green-imac',
                'A green 2021 apple Imac with the matching magic mouse and matching keyboard'
            ),
            static::addItem(
                'Climax — Rage against the facism', 
                'climax-ratf',
                'A orange magazine cover titled &quot;Climax Rage Against The Facism&quot;. The word fascism is breaking a Tesla Cyber Truck in half. There is some subtext under the Cyber Truck'
            ),
            static::addItem(
                'DAK—Saint-Tropez', 
                'dak-saint-tropez',
                'A yellow and white striped cardboard cofee box. On top is a white rectangular sticker that seals the box with Saint-Tropez written on it. On the front of the box is another sticker of a drawing of a person drinking a cup of coffee looking satisfied'
            ),
            static::addItem(
                'La vie secrète des arbres', 
                'la-vie-secrete-des-arbres',
                'The cover of the book &quot;La vie Secrète des Arbres&quot; by Peter Wohlleben. The background image is a fores. The name of the author is written in yellow above the title in white. At the bottom is a book banner with some text promoting the book and the amount of readers it got.'
            ),
            static::addItem(
                'Red Hario v60 kit', 
                'red-v60',
                'A red ceramic Hario V60 coffee dripper on top of it\'s glass carafe. There are also some filters laying down with a measuring spoon placed on top of them. In the back is the cardboard box in which it all comes.'
            ),
        ];
    }

    protected static function addItem(string $name, string $src, string $alt): object
    {
        return (object) [
            'name' => $name,
            'src' => $src,
            'alt' => $alt,
        ];
    }
}
