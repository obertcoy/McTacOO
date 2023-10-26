<?php

namespace App\Models\ProductTransaction;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductTransactionDetail extends Model
{
    use HasFactory;

    protected $table = 'product_transaction_details';

    protected $fillable = ['product_transaction_id', 'product_id', 'quantity'];

    public function transactionHeader(){
        return $this->belongsTo(ProductTransactionHeader::class, 'product_transaction_id');
    }
    public function product(){
        return $this->belongsTo(Product::class);
    }
}
