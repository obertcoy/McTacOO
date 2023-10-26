<?php

namespace App\Http\Controllers\PageController;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Transaction\Product\ProductPacketTransactionDetailController;
use App\Http\Controllers\Transaction\Product\ProductTransactionDetailController;
use App\Http\Controllers\Transaction\Product\ProductTransactionHeaderController;
use App\Models\ProductTransaction\ProductTransactionDetail;
use Illuminate\Http\Request;

class TransactionDetailPageController extends Controller
{
    private $productTransController;
    private $productTransDetailController;
    private $productPacketTransDetailController;

    public function __construct(ProductTransactionHeaderController $productTransController, ProductTransactionDetailController $productTransDetailController, ProductPacketTransactionDetailController $productPacketTransDetailController){
        $this->productTransController = $productTransController;
        $this->productTransDetailController = $productTransDetailController;
        $this->productPacketTransDetailController= $productPacketTransDetailController;
    }

    public function index($id){

        $products = $this->productTransDetailController->getTransactionProducts($id);
        $packets = $this->productPacketTransDetailController->getTransactionPackets($id);

        // dd($packets);
        return view('transaction-detail', [
            'products' => $products,
            'packets' => $packets,
            'transaction_id' => $id
        ]);
    }
}
