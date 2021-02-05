<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SystemConfig;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::where('Product_Status', 1)->orderBy('Product_Id', 'desc')->get();
        return view('user.index', compact('products'));
    }

    public function setting()
    {
        $setting = SystemConfig::orderBy('Id', 'desc')->first();
        return $setting;
    }

    public function products()
    {
        return view('user.products');
    }

    public function login()
    {
        return view('user.login');
    }

    public function details()
    {
        return view('user.details');
    }
}