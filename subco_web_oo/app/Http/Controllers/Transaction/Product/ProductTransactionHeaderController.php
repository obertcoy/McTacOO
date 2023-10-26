<?php

namespace App\Http\Controllers\Transaction\Product;

use App\Http\Controllers\Controller;
use App\Models\ProductTransaction\ProductTransactionHeader;
use Illuminate\Http\Request;

class ProductTransactionHeaderController extends Controller
{
    private $productTransHeaderModel;

    public function __construct(ProductTransactionHeader $productTransHeaderModel)
    {
        $this->productTransHeaderModel = $productTransHeaderModel;
    }

    public function getUserTransactions($user){
        return $this->productTransHeaderModel->getUserTransactions($user);
    }

    public function getBranchTransactions($branch_id){
        $transactions = ProductTransactionHeader::where('branch_id', $branch_id)->get();
        return $transactions;
    }
}
