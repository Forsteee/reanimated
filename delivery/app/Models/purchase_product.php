<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class purchase_product extends Model
{
    //use HasFactory;
    protected $table = 'purchase_products'; // таблица БД

    protected $primaryKey = 'id'; // ключик
    protected $fillable = [
        'order_id',
        'product_id',
        'count',
        'count_price',
    ]; // массово назначенные поля / с которыми работает пользователь

    public function order (){ // отношение M -> 1
        return $this->belongsTo(orders::class);
    }

    public function product_list (){ // отношение M -> 1 3й параметр -> связывающий столбец в род. таблице
        return $this->belongsTo(product_list::class);
    }

    public $timestamps = true; // create_at update_at create or not

    public function boot(){// исключение при заполнение несуществующего аттрибута / метод следует вызывать внутри bootметода одного из поставщиков услуг (application's providers)
        Model::preventSilentlyDiscardingAttributes($this->app->isLocal());
    }
}
