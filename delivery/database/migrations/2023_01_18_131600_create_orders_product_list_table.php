<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders_product_list', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('orders_id');
            $table->unsignedBigInteger('product_list_id');
            $table->foreign('orders_id')->references('id')->on('orders')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('product_list_id')->references('id')->on('product_lists')->onDelete('cascade')->onUpdate('cascade');
            $table->smallInteger('count')->default(1);
            $table->float('count_price', 8 , 2 )->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function(Blueprint $table){
            $table->dropForeign(['orders_id']);
            $table->dropForeign(['product_list_id']);
            $table->dropColumn(['orders_id']);
            $table->dropColumn(['product_list_id']);
        });

        Schema::dropIfExists('orders_product_list');
    }
};
