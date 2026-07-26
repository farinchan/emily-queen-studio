<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Photography;
use Illuminate\Http\Request;

class PhotographyController extends Controller
{
    public function show(string $slug)
    {
        $photography = Photography::where('slug', $slug)
            ->orWhere('id', $slug)
            ->firstOrFail();

        return view('front.pages.photography', [
            'photography' => $photography,
        ]);
    }
}
