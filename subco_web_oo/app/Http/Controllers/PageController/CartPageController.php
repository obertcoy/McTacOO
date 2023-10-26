<?php

namespace App\Http\Controllers\PageController;

use App\Http\Controllers\BranchController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CartPacketController;
use App\Http\Controllers\CartProductController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\PaymentController;
use App\Models\Product;
use App\Models\Promo;
use Illuminate\Http\Request;

class CartPageController extends Controller{

    private $cartController;
    private $cartProductController;
    private $cartPacketController;

    private $branchController;
    private $paymentController;

    public function __construct(CartController $cartController, CartProductController $cartProductController, CartPacketController $cartPacketController, BranchController $branchController, PaymentController $paymentController){
        $this->cartController = $cartController;
        $this->cartProductController = $cartProductController;
        $this->cartPacketController = $cartPacketController;
        $this->branchController = $branchController;
        $this->paymentController = $paymentController;


    }

    public function index(){

        if(auth()->user()->role_id == 1){
            return redirect()->back();
        }


        $carts = $this->cartController->getUserCart(auth()->user());
        $branches = $this->branchController->getAllBranches();
        $payments = $this->paymentController->getAllPayments();
        // dd($carts[auth()->user()->id - 1]->cartProducts() );
        return view('cart', ['carts' => $carts[auth()->user()->id - 1], 'branches' => $branches, 'payments' => $payments]);
    }

    public function cartProductDecrease($product_id){
        $cart = $this->cartController->getUserCart(auth()->user());

        if(!$cart)  return redirect()->back()->with('failed', 'Quantity decrease failed');

        if($this->cartProductController->cartProductDecrease($cart[auth()->user()->id  - 1], $product_id)){
            return redirect()->back()->with('success', 'Quantity decreased successfully');
        }

    }

    public function cartProductIncrease($product_id){
        $cart = $this->cartController->getUserCart(auth()->user());

        if(!$cart)  return redirect()->back()->with('failed', 'Quantity increase failed');

        if($this->cartProductController->cartProductIncrease($cart[auth()->user()->id - 1], $product_id)){
            return redirect()->back()->with('success', 'Quantity increased successfully');
        }

    }

    public function cartProductRemove($product_id){
        $cart = $this->cartController->getUserCart(auth()->user());

        if(!$cart)  return redirect()->back()->with('failed', 'Product removal failed');

        if($this->cartProductController->cartProductRemove($cart[auth()->user()->id - 1], $product_id)){
            return redirect()->back()->with('success', 'Product removed successfully');
        }

    }

    public function cartPacketDecrease($packet_id){
        $cart = $this->cartController->getUserCart(auth()->user());

        if(!$cart)  return redirect()->back()->with('failed', 'Quantity decrease failed');

        if($this->cartPacketController->cartPacketDecrease($cart[auth()->user()->id - 1], $packet_id)){
            return redirect()->back()->with('success', 'Quantity decreased successfully');
        }

    }

    public function cartPacketIncrease($packet_id){
        $cart = $this->cartController->getUserCart(auth()->user());

        if(!$cart)  return redirect()->back()->with('failed', 'Quantity increase failed');

        if($this->cartPacketController->cartPacketIncrease($cart[auth()->user()->id - 1], $packet_id)){
            return redirect()->back()->with('success', 'Quantity increased successfully');
        }

    }

    public function cartPacketRemove($packet_id){
        $cart = $this->cartController->getUserCart(auth()->user());

        if(!$cart)  return redirect()->back()->with('failed', 'Product removal failed');

        if($this->cartPacketController->cartPacketRemove($cart[auth()->user()->id - 1], $packet_id)){
            return redirect()->back()->with('success', 'Packet removed successfully');
        }

    }

    public function cartCheckout(Request $request, $cart_id){

        $cart = $this->cartController->getUserCart(auth()->user());

        if(!$cart || $cart[auth()->user()->id - 1]->id != $cart_id)  return redirect()->back()->with('failed', 'Cart invalid');

        // dd($cart[auth()->user()->id - 1]->cartProducts);
        if($this->cartController->cartCheckout($cart[auth()->user()->id - 1], $request->branch_id, $request->payment_id)){

            return redirect()->route('transaction')->with('success', 'Checkout successful');

        }

    }

}
