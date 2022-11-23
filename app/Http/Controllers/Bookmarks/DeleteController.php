<?php

namespace App\Http\Controllers\Bookmarks;

use App\Actions\Bookmarks\DeleteBookmark;
use App\Http\Controllers\Controller;
use App\Models\Bookmark;
use Illuminate\Http\RedirectResponse;

class DeleteController extends Controller
{
    public function __construct(private DeleteBookmark $deleteAction)
    {
    }
    
    public function __invoke(Bookmark $bookmark): RedirectResponse
    {
        $this->deleteAction->handle($bookmark);

        return redirect()->route('dashboard');
    }
}
