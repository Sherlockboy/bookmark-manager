<?php

namespace App\Http\Controllers\Bookmarks;

use App\Http\Controllers\Controller;
use App\Http\Requests\Bookmarks\StoreRequest;
use App\Models\Tag;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;

class StoreController extends Controller
{
    public function __invoke(StoreRequest $request): RedirectResponse
    {
        $bookmark = auth()->user()->bookmarks()->create([
            'name' => $request->get('name'),
            'url' => $request->get('url'),
            'description' => $request->get('description'),
        ]);
        
        foreach (explode(',', $request->get('tags')) as $tagName) {
            $tag = Tag::query()->firstOrCreate([
                'name' => trim(strtolower($tagName)),
                'slug' => Str::slug($tagName),
            ]);
            
            $bookmark->tags()->attach($tag->id);
        }
        
        return redirect()->route('dashboard');
    }
}
