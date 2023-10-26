<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePacketProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('packet_products', function (Blueprint $table) {
            $table->unsignedBigInteger('packet_id');
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('quantity');

            $table->primary(['packet_id', 'product_id']);
            $table->foreign('packet_id')->references('id')->on('packets')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('packet_products');
    }
}
