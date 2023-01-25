<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\product_list;

class ProductController extends Controller
{
    //
    public function product_page($product_id){
        $product = product_list::find($product_id); // найти продукт по идентификатору -> отправить во вьюшку
        return view('product',compact('product'));
    }
}
