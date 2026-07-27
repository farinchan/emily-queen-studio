<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'About',
            'users' => User::where('is_show', true)
                ->orderByRaw('`order` IS NULL, `order` ASC')
                ->orderBy('id', 'asc')
                ->get(),
        ];
        return view('front.pages.about', $data);
    }
}
