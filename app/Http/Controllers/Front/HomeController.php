<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Visitor;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        try {
            $userAgent = $request->userAgent() ?: '';

            $platform = 'Desktop';
            if (preg_match('/macintosh|mac os x/i', $userAgent)) {
                $platform = 'macOS';
            } elseif (preg_match('/windows/i', $userAgent)) {
                $platform = 'Windows';
            } elseif (preg_match('/android/i', $userAgent)) {
                $platform = 'Android';
            } elseif (preg_match('/iphone|ipad/i', $userAgent)) {
                $platform = 'iOS';
            } elseif (preg_match('/linux/i', $userAgent)) {
                $platform = 'Linux';
            }

            $browser = 'Chrome';
            if (preg_match('/firefox/i', $userAgent)) {
                $browser = 'Firefox';
            } elseif (preg_match('/safari/i', $userAgent) && !preg_match('/chrome/i', $userAgent)) {
                $browser = 'Safari';
            } elseif (preg_match('/edg/i', $userAgent)) {
                $browser = 'Edge';
            }

            $device = 'Desktop';
            if (preg_match('/mobile|iphone/i', $userAgent)) {
                $device = 'Mobile';
            } elseif (preg_match('/ipad|tablet/i', $userAgent)) {
                $device = 'Tablet';
            }

            Visitor::create([
                'ip' => $request->ip() ?: '127.0.0.1',
                'country' => 'Indonesia',
                'city' => 'Jakarta',
                'region' => 'DKI Jakarta',
                'user_agent' => substr($userAgent, 0, 255),
                'platform' => $platform,
                'browser' => $browser,
                'device' => $device,
            ]);
        } catch (\Throwable $e) {}

        $data = [
            'banners' => Banner::orderBy('id')->get(),
        ];

        return view('front.pages.home', $data);
    }
}
