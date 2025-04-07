<?php

namespace App\Hiker\Chrome;

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
