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

    public function purchase_products(){ // отношение 1 -> M
        return $this -> hasMany(purchase_product::class,'order_id');
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

    /*public function boot(){// исключение при заполнение несуществующего аттрибута / метод следует вызывать внутри bootметода одного из поставщиков услуг (application's providers)
        Model::preventSilentlyDiscardingAttributes($this->app->isLocal());
    }*/
}
