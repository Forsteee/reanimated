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
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->float('full_price', 8 , 2 );
            $table->string('adress')->nullable(true);
            $table->boolean('payment')->default(false);
            $table->boolean('delivery')->default(false);
            $table->dateTime('time_delivery_start')->nullable(true);
            $table->dateTime('time_delivery_end')->nullable(true);
            $table->unsignedBigInteger('payment_method_id')->nullable(true);
            $table->unsignedBigInteger('delivery_man_id')->nullable(true);
            $table->unsignedBigInteger('customer_id')->nullable(true);
            $table->foreign('payment_method_id')->references('id')->on('payment_methods')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('delivery_man_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('customer_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
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
            $table->dropForeign(['payment_method_id']);
            $table->dropForeign(['delivery_man_id']);
            $table->dropForeign(['customer_id']);
            $table->dropColumn(['payment_method_id']);
            $table->dropColumn(['delivery_man_id']);
            $table->dropColumn(['customer_id']);
        });

        Schema::dropIfExists('orders');
    }
};
