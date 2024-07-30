<?php

namespace App\Entities;

use DateTime;

class Post
{
    public function __construct(
        public string $title,
        public string $excerpt,
        public DateTime $created_at,
        public string $link,
        public string $body,
    ){}
}
