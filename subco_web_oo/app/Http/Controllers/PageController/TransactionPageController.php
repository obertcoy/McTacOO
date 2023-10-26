<?php

namespace App\Http\Controllers\PageController;

use App\Http\Controllers\BranchController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Transaction\Product\ProductPacketTransactionDetailController;
use App\Http\Controllers\Transaction\Product\ProductTransactionDetailController;
use App\Http\Controllers\Transaction\Product\ProductTransactionHeaderController;
use App\Models\ProductTransaction\ProductTransactionDetail;
use App\Models\ProductTransaction\ProductTransactionHeader;
use Illuminate\Http\Request;

class TransactionPageController extends Controller
{

    private $productTransController;
    private $productTransDetailController;
    private $productPacketTransDetailController;

    private $branchController;

    public function __construct(ProductTransactionHeaderController $productTransController, ProductTransactionDetailController $productTransDetailController, ProductPacketTransactionDetailController $productPacketTransDetailController,
    BranchController $branchController){
        $this->productTransController = $productTransController;
        $this->productTransDetailController = $productTransDetailController;
        $this->productPacketTransDetailController= $productPacketTransDetailController;
        $this->branchController = $branchController;
    }

    public function index(Request $request)
{
    if(auth()->user()->role->id == 2){
        $productTransactions = $this->productTransController->getUserTransactions(auth()->user());
        return view('transaction', ['productTransactions' => $productTransactions, 'branches' => null]);
    }

    $branch_id = $request->branch_id ?? 1;

    $branches = $this->branchController->getAllBranches();
    $productTransactions = $this->productTransController->getBranchTransactions($branch_id);

    return view('transaction', ['productTransactions' => $productTransactions, 'branches' => $branches, 'selectedBranchID' => $branch_id]);
}


}
