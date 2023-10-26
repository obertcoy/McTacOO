<?php

namespace App\Http\Controllers\Transaction\Product;

use App\Http\Controllers\Controller;
use App\Models\ProductTransaction\ProductTransactionDetail;
use Illuminate\Http\Request;

class ProductTransactionDetailController extends Controller
{
    public function getTransactionProducts($id){
        return ProductTransactionDetail::where('product_transaction_id', $id)->get();
    }
}
