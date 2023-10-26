<?php

namespace App\Http\Controllers;

use App\Models\Cart\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{

    private $cartModel;

    public function __construct(Cart $cartModel)
    {
        $this->cartModel = $cartModel;
    }

    public function getUserCart($user){
        return $user->cart->with(['cartProducts', 'cartPackets'])->get();
    }
    public function cartCheckout($cart, $branch_id, $payment_id){
        return $this->cartModel->cartCheckout($cart, $branch_id, $payment_id);
    }
}
