<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    private $productModel;

    public function __construct(Product $productModel)
    {
        $this->productModel = $productModel;
    }

    public function getAllProducts(){
        return $this->productModel->getAllProducts();
    }

    public function getProduct($id){
        return Product::find($id);
    }

    public function searchProduct($query){
        return Product::where('name', 'like', '%' . $query . '%')->get();
    }

}
