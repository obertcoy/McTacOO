<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductPacketTransactionDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_packet_transaction_details', function (Blueprint $table) {
            $table->unsignedBigInteger('product_transaction_id');
            $table->unsignedBigInteger('packet_id');
            $table->unsignedBigInteger('quantity');

            $table->primary(['product_transaction_id', 'packet_id'], 'product_packet_transaction_pk');
            $table->foreign('product_transaction_id', 'product_packet_transaction_fk')->references('id')->on('product_transaction_headers')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('packet_id', 'product_packet_packet_fk')->references('id')->on('packets')->onUpdate('cascade')->onDelete('cascade');

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
        Schema::dropIfExists('product_packet_transaction_details');
    }
}
