<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\InstagramMedia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class InstagramFeedController extends Controller
{
    public function __invoke(Request $request)
    {
        $page = (int) $request->get('page', 1);

        if ($page === 1) {
            $posts = Cache::remember('instagram:feed:page:1', 300, function () {
                return InstagramMedia::visible()
                    ->orderByDesc('posted_at')
                    ->paginate(12);
            });
        } else {
            $posts = InstagramMedia::visible()
                ->orderByDesc('posted_at')
                ->paginate(12);
        }

        return view('instagram.feed', [
            'posts' => $posts,
        ]);
    }
}
