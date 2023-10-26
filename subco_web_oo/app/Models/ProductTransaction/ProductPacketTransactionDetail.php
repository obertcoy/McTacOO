<?php

namespace App\Models\ProductTransaction;

use App\Models\Packet;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductPacketTransactionDetail extends Model
{
    use HasFactory;

    protected $table = 'product_packet_transaction_details';

    protected $fillable = ['product_transaction_id', 'packet_id', 'quantity'];

    public function transactionHeader(){
        return $this->belongsTo(ProductTransactionHeader::class, 'product_transaction_id');
    }

    public function packet(){
        return $this->belongsTo(Packet::class);
    }
}
