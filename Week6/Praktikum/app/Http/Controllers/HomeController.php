<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Halaman Home',
            'list' => ['Home']
        ];
        $page = (object) [
            'title' => 'Selamat datang di halaman home'
        ];
        $activeMenu = 'dashboard'; // set menu yang sedang aktif
        return view('welcome', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu]);
    }
}
