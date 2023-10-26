<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductTransactionDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_transaction_details', function (Blueprint $table) {
            $table->unsignedBigInteger('product_transaction_id');
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('quantity');

            $table->primary(['product_transaction_id', 'product_id'], 'product_transaction_pk');
            $table->foreign('product_transaction_id', 'product_transaction_fk')->references('id')->on('product_transaction_headers')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('product_id', 'product_product_fk')->references('id')->on('products')->onUpdate('cascade')->onDelete('cascade');

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
        Schema::dropIfExists('product_transaction_details');
    }
}
