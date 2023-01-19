<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product_category extends Model
{
    //use HasFactory;
    protected $table = 'product_categories'; // таблица БД

    protected $primaryKey = 'id'; // ключик
    protected $fillable = ['name']; // массово назначенные поля / с которыми работает пользователь

    public function product_lists(){ // отношение 1 -> M
        return $this -> hasMany(product_list::class);
    }

    public $timestamps = true; // create_at update_at create or not

    /*public function boot(){// исключение при заполнение несуществующего аттрибута / метод следует вызывать внутри bootметода одного из поставщиков услуг (application's providers)
        Model::preventSilentlyDiscardingAttributes($this->app->isLocal());
    }*/
}
