<?php

namespace App\Hiker\Chrome;

use App\Hiker\Resources\Links\Link as LinkResource;
use App\Hiker\Resources\Notes\Note;
use Hiker\Components\Navigation\Group;
use Hiker\Components\Navigation\Link;
use Hiker\Components\Navigation\NavigationConstructor;

class Navigation extends NavigationConstructor
{
    /**
     * Return the navigation items
     */
    protected function items(): array
    {
        return [
            $this->dashboard(),
            $this->search(),
            Group::make()->links([
                Link::make()->resource(LinkResource::class),
                Link::make()->resource(Note::class),
            ]),
        ];
    }

    /**
     * Return the sticky navigation items
     */
    protected function sticky(): array
    {
        return [
            //
        ];
    }
}
