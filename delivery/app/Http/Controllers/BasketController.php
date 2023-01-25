<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BasketController extends Controller
{
    //
    public function basket($order_id = null){
        return view('basket', compact('order_id'));
    }
}
