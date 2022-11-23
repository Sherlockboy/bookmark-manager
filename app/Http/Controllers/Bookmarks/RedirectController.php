<?php

namespace App\Http\Controllers\Bookmarks;

use App\Http\Controllers\Controller;
use App\Models\Bookmark;
use Illuminate\Http\Request;
use JustSteveKing\UriBuilder\Uri;

class RedirectController extends Controller
{
    public function __invoke(Bookmark $bookmark)
    {
        $url = Uri::fromString(
            uri: $bookmark->url,
        )->addQueryParam(
            key: 'utm_campaign',
            value: 'bookmarker_' . auth()->id(),
        )->addQueryParam(
            key: 'utm_source',
            value: 'Bookmarker App'
        )->addQueryParam(
            key: 'utm_medium',
            value: 'website',
        );
        
        return redirect(
            $url->toString(),
        );
    }
}
