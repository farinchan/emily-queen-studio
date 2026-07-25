<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Pengguna',
            'subtitle' => 'Pengguna dan Hak Akses',
            'breadcrumbs' => [
                ['name' => 'Dashboard', 'url' => route('admin.dashboard')],
                ['name' => 'Pengguna', 'url' => route('admin.users.index')],
            ],
            'users' => User::all(),
        ];

        return view('admin.pages.users', $data);
    }
}
