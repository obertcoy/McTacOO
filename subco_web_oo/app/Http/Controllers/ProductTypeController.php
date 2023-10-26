<?php

namespace App\Http\Controllers;

use App\Models\ProductType;
use Illuminate\Http\Request;

class ProductTypeController extends Controller
{

    private $productTypeModel;

    public function __construct(ProductType $productTypeModel)
    {
        $this->productTypeModel = $productTypeModel;
    }

    public function getAllProductsBasedOnType(){
        return $this->productTypeModel->getAllProductsBasedOnType();
    }

    

}
