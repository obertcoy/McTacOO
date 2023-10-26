<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    public function branches()
    {
        return $this->belongsToMany(Branch::class, 'branch_products', 'product_id', 'branch_id');
    }

    public function events()
    {
        return $this->belongsToMany(Event::class, 'event_products', 'product_id', 'event_id');
    }

    public function productType()
    {
        return $this->belongsTo(ProductType::class, 'type_id');
    }

    public function packets(){
        return $this->belongsToMany(Packet::class, 'packet_products', 'product_id', 'packet_id');
    }

    public function getAllProducts()
    {
        return Product::all();
    }

    public function addToCartProduct(Request $request)
    {

        $id = $request->product_id;
        $quantity = $request->product_quantity;

        $product = Product::find($id);

        if (!$product) return redirect()->back()->with('failed', 'Product not found');

        $user = auth()->user();
        $cart = $user->cart;

        $existingProduct = $cart->cartProducts()->where('product_id', $product->id)->first();

        if ($existingProduct) {
            DB::table('cart_products')
            ->where('cart_id', $cart->id)
            ->where('product_id', $product->id)
            ->update(['quantity' => $existingProduct->quantity + $quantity]);
        } else {
            $cart->cartProducts()->create([
                'product_id' => $product->id,
                'quantity' => $quantity,
            ]);
        }

        return redirect()->back()->with('success', 'Product added to cart');
    }
}
