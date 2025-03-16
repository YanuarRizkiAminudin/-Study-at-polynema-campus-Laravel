<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    //================ Jobsheet 2 ==============
    public function foodBeverage() {
        return view('product.food-beverage');   // Menampilkan view 'product/food-beverage.blade.php'
    }

    public function beautyHealth() {
        return view('product.beauty-health');   // Menampilkan view 'product/beauty-health.blade.php'
    }

    public function homeCare() {
        return view('product.home-care');   // Menampilkan view 'product/home-care.blade.php'
    }

    public function babyKid() {
        return view('product.baby-kid');    // Menampilkan view 'product/baby-kid.blade.php'
    }
}