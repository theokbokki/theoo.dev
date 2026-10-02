<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        return view('home', [
            'theme' => $this->theme(),
        ]);
    }

    protected function theme(): object
    {
        $n = rand(0, 7);

        $bg = [
            '255, 245, 245',
            '255, 250, 245',
            '255, 254, 245',
            '245, 255, 246',
            '245, 253, 255',
            '245, 248, 255',
            '253, 245, 255',
            '255, 245, 252',
        ];

        $link = [
            '255, 0, 0',
            '255, 136, 0',
            '218, 194, 11',
            '0, 204, 27',
            '0, 184, 229',
            '0, 68, 255',
            '204, 0, 255',
            '255, 0, 170',
        ];

        return (object) [
            'bg' => $bg[$n],
            'link' => $link[$n],
        ];
    }
}
