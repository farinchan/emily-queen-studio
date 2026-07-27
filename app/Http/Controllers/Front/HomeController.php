<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Photography;
use App\Models\Visitor;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        Visitor::create([
            'ip' => $request->ip() ?: '127.0.0.1',
            'country' => 'Indonesia',
            'user_agent' => substr((string) $request->userAgent(), 0, 255),
            'platform' => 'macOS',
            'browser' => 'Chrome',
            'device' => 'Desktop',
        ]);

        $data = [
            'banners' => Banner::orderBy('id')->get(),
            'photographies' => Photography::latest()->get(),
        ];

        return view('front.pages.home', $data);
    }
}
