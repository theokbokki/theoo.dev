<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class ProjectsController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $view = view('projects', [
            'projects' => Post::query()
                ->projects()
                ->published()
                ->orderByDesc('published_at')
                ->get(),
        ]);

        if ($request->ajax()) {
            return response()->json(['html' => $view->render()]);
        }

        return $view;
    }
}
