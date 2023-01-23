<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class roles extends Model
{
    //use HasFactory;

    protected $table = 'roles'; // таблица БД

    protected $primaryKey = 'id'; // ключик
    protected $fillable = ['name']; // массово назначенные поля / с которыми работает пользователь

    // значение по умолчанию для поля нового экземпляра 
    /*protected $attributes = [
        'delayed' => false,
    ];*/

     public function users(){ // отношение 1 -> M
        return $this -> hasMany(User::class,'role_id');
     }

    public $timestamps = false; // create_at update_at create or not

    /*public function boot(){// исключение при заполнение несуществующего аттрибута / метод следует вызывать внутри bootметода одного из поставщиков услуг (application's providers)
        Model::preventSilentlyDiscardingAttributes($this->app->isLocal());
    }*/
   
}
