<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class payment_method extends Model
{
    //use HasFactory;
    protected $table = 'payment_methods'; // таблица БД

    protected $primaryKey = 'id'; // ключик
    protected $fillable = ['name']; // массово назначенные поля / с которыми работает пользователь

    public function product_categories(){ // отношение 1 -> M
        return $this -> hasMany(product_category::class);
    }

    public $timestamps = false; // create_at update_at create or not

    public function boot(){// исключение при заполнение несуществующего аттрибута / метод следует вызывать внутри bootметода одного из поставщиков услуг (application's providers)
        Model::preventSilentlyDiscardingAttributes($this->app->isLocal());
    }
}
