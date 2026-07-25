<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $data = [
            'banners' => Banner::orderBy('id')->get(),
        ];
        return view('front.pages.home', $data);
    }
}
