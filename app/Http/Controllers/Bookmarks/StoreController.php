<?php

declare(strict_types=1);

namespace App\Http\Controllers\Bookmarks;

use App\Actions\Bookmarks\CreateBookmarkAndTags;
use App\Http\Controllers\Controller;
use App\Http\Requests\Bookmarks\StoreRequest;
use Illuminate\Http\RedirectResponse;

class StoreController extends Controller
{
    public function __construct(private CreateBookmarkAndTags $storeAction)
    {
    }
    
    public function __invoke(StoreRequest $request): RedirectResponse 
    {
        $this->storeAction->handle(
            request: $request->validated(), 
            userId: auth()->id()
        );

        return redirect()->route('dashboard');
    }
}
