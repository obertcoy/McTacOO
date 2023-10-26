<?php

namespace App\Http\Controllers\Transaction\Product;

use App\Http\Controllers\Controller;
use App\Models\ProductTransaction\ProductPacketTransactionDetail;
use Illuminate\Http\Request;

class ProductPacketTransactionDetailController extends Controller
{
    public function getTransactionPackets($id){
        return ProductPacketTransactionDetail::where('product_transaction_id', $id)->get();
    }
}
