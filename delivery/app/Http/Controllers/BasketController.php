<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\orders;

use function PHPUnit\Framework\isNull;

class BasketController extends Controller
{
    //
    public function basket(){// вывод корзины заказа
        $order_id = session('order_id');
        if(!is_null($order_id)){
            $order = orders::findOrFail($order_id);
        }
        return view('basket', compact('order'));
    }

    public function basketAdd($product_id){ // добавить товар
        $order_id = session('order_id'); // ищем в сессии заказ
        if(is_null($order_id)){
            $order_id = orders::create()->id;
            session(['order_id'=> $order_id]); // создаём и кладем заказ в сессию если небыло
        }
        $order = orders::find($order_id);
        
        //dd(session('order_id'));
        if($order->products->contains($product_id)){
            $product = $order->products()->where('product_list_id', $product_id)->first();
            $pivotRow = $product->pivot;//  связанные строки в смежной таблице
            $pivotRow->count++;// увеличиваем число товаров          /        это действо стоит перенести в метод модели?
            $pivotRow -> update(); // сохраняем новое знначение
        }else{
            $order -> products() -> attach($product_id);// создаем строку в смежной таблице если товара в заказе нет
        }
        
        return redirect()->route('basket');
    }

    public function deleteProduct($product_id){ // удаление товара из корзины 
        $order_id = session('order_id');
        if(is_null($order_id)){
            return redirect()->route('basket');
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

    public function basketConfirmForm(){ // переход на страницу подтверждения заказа
        $order_id = session('order_id');
        if(is_null($order_id)){
            return redirect()->route('index');
        }
        //добавить передачу order для вывода заказа?
        return view('orderconfirm');
    }

    public function orderConfirm(Request $request){ // подтверждение заказа (пока просто запись в таблицу orders данных + чек оформления)
        $order_id = session('order_id');
        if(is_null($order_id)){
            return redirect()->route('index');
        }
        $order=orders::find($order_id);
        $confirm = $order->saveOrder($request->fio, $request->address, $request->telephone);
        return redirect()->route('index');
    }
}
