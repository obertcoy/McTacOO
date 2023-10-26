<?php

namespace App\Models\Cart;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CartProduct extends Model
{
    use HasFactory;

    protected $table = 'cart_products';
    protected $primaryKey = 'cart_id';

    protected $fillable = ['product_id', 'quantity'];

    public function cart(){
        return $this->belongsTo(Cart::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function addToCartProduct($product_id, $quantity, $user)
    {

        $cart = $user->cart;

        $existingProduct = $cart->cartProducts()->where('product_id', $product_id)->first();

        if ($existingProduct) {
            DB::table('cart_products')
            ->where('cart_id', $cart->id)
            ->where('product_id', $product_id)
            ->update(['quantity' => $existingProduct->quantity + $quantity]);
        } else {
            $cart->cartProducts()->create([
                'product_id' => $product_id,
                'quantity' => $quantity,
            ]);
        }

        return redirect()->back()->with('success', 'Product added to cart');
    }

    public function cartProductDecrease($cart, $product_id){
        $cartProduct = $cart->cartProducts()->where('product_id', $product_id)->first();
        if ($cartProduct) {
            $newQuantity = max($cartProduct->quantity - 1, 0);

            DB::table('cart_products')
                ->where('cart_id', $cart->id)
                ->where('product_id', $product_id)
                ->update(['quantity' => $newQuantity]);

            if ($newQuantity === 0) {
                DB::table('cart_products')
                ->where('cart_id', $cart->id)
                ->where('product_id', $product_id)
                ->delete();
            }

            return response()->json(['message' => 'Quantity decreased successfully', 'cartProduct' => $cartProduct]);
        }
    }

    public function cartProductIncrease($cart, $product_id){
        $cartProduct = $cart->cartProducts()->where('product_id', $product_id)->first();
        if ($cartProduct) {

            DB::table('cart_products')
                ->where('cart_id', $cart->id)
                ->where('product_id', $product_id)
                ->update(['quantity' => $cartProduct->quantity + 1]);

            return response()->json(['message' => 'Quantity increased successfully', 'cartProduct' => $cartProduct]);
        }

        return $cartProduct;
    }

    public function cartProductRemove($cart, $product_id){
        $cartProduct = $cart->cartProducts()->where('product_id', $product_id)->first();
        if ($cartProduct) {

            DB::table('cart_products')
                ->where('cart_id', $cart->id)
                ->where('product_id', $product_id)
                ->delete();

                return response()->json(['message' => 'Product removed']);
            }

        return $cartProduct;
    }


}
