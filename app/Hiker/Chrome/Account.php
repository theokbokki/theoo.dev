<?php

namespace App\Hiker\Chrome;

use Hiker\Views\Component;
use Hiker\Components\Navigation\Link;
use Hiker\Components\Dropdown\Section;
use Hiker\Components\Dropdown\Dropdown;
use Hiker\Components\Account\AccountConstructor;

class Account extends AccountConstructor
{
    /**
     * Return the Account Menu Sections.
     */
    protected function dropdown(): Component
    {
        return Dropdown::make([
            Section::make()
                ->components([
                    Link::make('Log out')
                        ->icon('exit-logout')
                        ->route('auth.logout')
                        ->method('post'),
                ]),
        ]);
    }
}
