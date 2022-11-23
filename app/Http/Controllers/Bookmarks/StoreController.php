<?php

declare(strict_types=1);

namespace App\Http\Controllers\Bookmarks;

use App\Actions\Bookmarks\CreateBookmarkAndTags;
use App\Http\Controllers\Controller;
use App\Http\Requests\Bookmarks\StoreRequest;
use Illuminate\Http\RedirectResponse;

class StoreController extends Controller
{
    public function __invoke(StoreRequest $request): RedirectResponse 
    {
        (new CreateBookmarkAndTags)->handle(
            $request->validated(), 
            auth()->id()
        );

        return redirect()->route('dashboard');
    }
}
