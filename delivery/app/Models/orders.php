<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class orders extends Model
{
    //use HasFactory;
    protected $table = 'orders'; // таблица БД

    protected $primaryKey = 'id'; // ключик
    protected $fillable = [
        'full_price',
        'adress',
        'fio',
        'telephone',
        'payment',
        'delivery',
        'time_delivery_start',
        'time_delivery_end',
        'payment_method_id',
        'delivery_man_id',
        'customer_id',
    ]; // массово назначенные поля / с которыми работает пользователь

    // значение по умолчанию для поля нового экземпляра 
    protected $attributes = [
        'payment' => false,
        'delivery' => false,
    ];

    public function products(){
        return $this -> belongsToMany(product_list::class)->withPivot('count', 'count_price')->withTimestamps();
    }

    public function orders_product_lists(){ // отношение 1 -> M
        return $this -> hasMany(orders_product_list::class,'orders_id');
    }

    public function payment_method (){ // отношение M -> 1
        return $this->belongsTo(payment_method::class,'payment_method_id');
    }

    public function delivery_man (){ // отношение M -> 1 
        return $this->belongsTo(User::class, 'delivery_man_id');//not check
    }

    public function customer (){ // отношение M -> 1
        return $this->belongsTo(User::class, 'customer_id');////not check
    }

    public $timestamps = true; // create_at update_at create or not

    public function fullPrice(){ // расчет полной цены заказа ч-з count_price смежной таблицы
        $full_price = 0;
        foreach($this->products as $product){
            $full_price += $product->pivot->count_price;
        }

        $this->full_price = $full_price;
        $this->update();

        return $full_price;
    }

    public function saveOrder($fio, $address, $telephone){ // подтверждение заказа (dtlivery поле в БД -> true)
        if($this->delivery == 0){
            $this->fio=$fio;
            $this->telephone=$telephone;
            $this->adress=$address;
            $this->delivery = 1;
            $this->save();
            session()->forget('order_id'); // очистка заказа в сессии
            return true;
        }else{
            return false;
        }
    }

    /*public function boot(){// исключение при заполнение несуществующего аттрибута / метод следует вызывать внутри bootметода одного из поставщиков услуг (application's providers)
        Model::preventSilentlyDiscardingAttributes($this->app->isLocal());
    }*/
}
