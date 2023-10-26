<?php

namespace App\Models\ProductTransaction;

use App\Models\Branch;
use App\Models\Payment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductTransactionHeader extends Model
{
    use HasFactory;

    protected $table = 'product_transaction_headers';
    protected $fillable = ['user_id', 'branch_id', 'payment_id'];

    public function transactionProducts(){
        return $this->hasMany(ProductTransactionDetail::class, 'product_transaction_id');
    }

    public function transactionPackets(){
        return $this->hasMany(ProductPacketTransactionDetail::class, 'product_transaction_id');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function branch(){
        return $this->belongsTo(Branch::class);
    }

    public function payment(){
        return $this->belongsTo(Payment::class);
    }

    public function getUserTransactions($user){
        return $user->productTransactions()->with(['transactionProducts', 'transactionPackets'])->get();
    }


}
