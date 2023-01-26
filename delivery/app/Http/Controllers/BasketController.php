<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\orders;

use function PHPUnit\Framework\isNull;

class BasketController extends Controller
{
    //
    public function basket(){

        $order_id = session('order_id');
        if(!is_null($order_id)){
            $order = orders::findOrFail($order_id);
        }
        return view('basket', compact('order'));
    }

    public function basketAdd($product_id){
        $order_id = session('order_id');
        if(is_null($order_id)){
            $order = orders::create()->id;
            session(['order_id'=> $order]);
        }else{
            $order = orders::find($order_id);
        }
        //dd($order);
        if($order->products->contains($product_id)){
            $countRow = $order->products()->where('product_list_id', $product_id)->first()->pivot;
            $countRow->count++;
            $countRow -> update();
        }else{
            $order -> products() -> attach($product_id);
        }
        

        return redirect()->route('basket');
    }

    public function deleteProduct($product_id){
        $order_id = session('order_id');
        if(is_null($order_id)){
            return redirect()->route('basket');
        }else{
            
        }
        $order=orders::find($order_id);

        if($order->products->contains($product_id)){
            $countRow = $order->products()->where('product_list_id', $product_id)->first()->pivot;
            if($countRow->count > 1){
                $countRow->count--;
                $countRow->update();
            }else{
                $order->products()->detach($product_id);
            }
        }else{
            
        }
        return redirect()->route('basket');

    }
}
