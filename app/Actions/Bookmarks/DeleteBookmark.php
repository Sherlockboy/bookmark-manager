<?php

declare(strict_types=1);

namespace App\Actions\Bookmarks;

use App\Models\Bookmark;

class DeleteBookmark
{
    public function handle(Bookmark $bookmark): bool
    {
        return $bookmark->delete();
    }
}
