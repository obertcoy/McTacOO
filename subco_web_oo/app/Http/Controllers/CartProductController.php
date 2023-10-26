<?php

namespace App\Http\Controllers;

use App\Models\Cart\CartProduct;
use Illuminate\Http\Request;

class CartProductController extends Controller
{

    private $cartProductModel;

    public function __construct(CartProduct $cartProductModel)
    {
        $this->cartProductModel = $cartProductModel;
    }
    public function addToCartProduct($product_id, $quantity, $user){
        return $this->cartProductModel->addToCartProduct($product_id, $quantity, $user);
    }

    public function cartProductDecrease($cart, $product_id){
        return $this->cartProductModel->cartProductDecrease($cart, $product_id);;
    }

    public function cartProductIncrease($cart, $product_id){
        return $this->cartProductModel->cartProductIncrease($cart, $product_id);;
    }
    public function cartProductRemove($cart, $product_id){
        return $this->cartProductModel->cartProductRemove($cart, $product_id);;
    }
    
}
