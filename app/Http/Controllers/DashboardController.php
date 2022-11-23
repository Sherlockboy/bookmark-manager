<?php

namespace App\Http\Controllers;

use App\Models\Bookmark;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __invoke(Request $request)
    {
        return view('dashboard', [
            'bookmarks' => Bookmark::query()
                ->where('user_id', auth()->id())
                ->with('tags')
                ->get()
        ]);
    }
}
