<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product_list extends Model
{
    //use HasFactory;
    protected $table = 'product_lists'; // таблица БД

    protected $primaryKey = 'id'; // ключик
    protected $fillable = [
        'name',
        'description',
        'price',
        'category_id',
    ]; // массово назначенные поля / с которыми работает пользователь

    public function product_category (){ // отношение M -> 1
        return $this->belongsTo(product_category::class,'category_id');
    }

    public $timestamps = true; // create_at update_at create or not

    public function countPrice(){ // общая сумма товара в межной таблице
        $count_price = 0;
        if(!is_null($this->pivot)){
            $count_price = $this->price * $this->pivot->count;
        }else $count_price = $this->price;

        $this->pivot->count_price = $count_price;
        $this->pivot->update();
        
        return $count_price;
    }

    /*public function boot(){// исключение при заполнение несуществующего аттрибута / метод следует вызывать внутри bootметода одного из поставщиков услуг (application's providers)
        Model::preventSilentlyDiscardingAttributes($this->app->isLocal());
    }*/
}
