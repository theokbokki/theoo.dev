<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;

class RssFeedController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $notes = Note::query()->published()->orderByDesc('updated_at')->get();

        return response()
            ->view('rss', [
                'notes' => $notes,
            ])
            ->header('Content-Type', 'text/xml');
    }
}
