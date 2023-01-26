<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\product_list;
use App\Models\product_category;
use App\Models\orders;

class HomeController extends Controller
{
    //
    public function index(){// 
        $products = product_list::get(); // каталог продуктов
        return view('home', compact('products'));
    }

    public function categories($category = null){ // вывод категорий на страницу категорий or вывод на главную товаров одной категории
        //dd($category);
        if($category == null){
            $categories = product_category::get(); // каталог категорий
            return view('categories', compact('categories'));
        }else{
            $products = product_category::find($category)->product_lists; // товары одной категории (потом сделаю отдельную страничку с товарами одной категории с выбором категории (сайд бар какой-нибудь))
            return view('home', compact('products'));
        } 
    }
}
