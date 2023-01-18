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
        Schema::create('product_lists', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->char('name', 100);
            $table->string('description');
            $table->float('price', 8 , 2 );
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('product_categories')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::table('product_lists', function(Blueprint $table){
            $table->dropForeign(['category_id']);
            $table->dropColumn(['category_id']);
        });
        Schema::dropIfExists('product_lists');
    }
};
