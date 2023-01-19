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

    public function purchase_products(){ // отношение 1 -> M
        return $this -> hasMany(purchase_product::class);
     }

    public function payment_method (){ // отношение M -> 1
        return $this->belongsTo(payment_method::class);
    }

    public function delivery_man (){ // отношение M -> 1 3й параметр -> связывающий столбец в род. таблице
        return $this->belongsTo(User::class, 'id', 'delivery_man_id');
    }

    public function customer (){ // отношение M -> 1 3й параметр -> связывающий столбец в род. таблице
        return $this->belongsTo(User::class, 'id', 'customer_id');
    }

    public $timestamps = true; // create_at update_at create or not

    public function boot(){// исключение при заполнение несуществующего аттрибута / метод следует вызывать внутри bootметода одного из поставщиков услуг (application's providers)
        Model::preventSilentlyDiscardingAttributes($this->app->isLocal());
    }
}
