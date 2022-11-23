<?php

declare(strict_types=1);

namespace App\Actions\Bookmarks;

use App\Models\Tag;
use Illuminate\Support\Str;

class CreateBookmarkAndTags
{
    public function handle(array $request, int $userId): void
    {
        $bookmark = auth()->user()->bookmarks()->create([
            'name' => $request['name'],
            'url' => $request['url'],
            'description' => $request['description'],
        ]);
        
        foreach (explode(',', $request['tags']) as $tagName) {
            $tag = Tag::query()->firstOrCreate([
                'name' => trim(strtolower($tagName)),
                'slug' => Str::slug($tagName),
            ]);
            
            $bookmark->tags()->attach($tag->id);
        }
    }
}
