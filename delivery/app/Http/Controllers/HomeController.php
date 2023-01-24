<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\product_list;

class HomeController extends Controller
{
    //
    public function index(){
        $products = product_list::get();
        return view('home', compact('products'));
    }
}
