<?php

namespace App\Models\Cart;

use App\Http\Controllers\UserController;
use App\Models\ProductTransaction\ProductPacketTransactionDetail;
use App\Models\ProductTransaction\ProductTransactionDetail;
use App\Models\ProductTransaction\ProductTransactionHeader;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $table = 'carts';

    public function cartPackets()
    {
        return $this->hasMany(CartPacket::class, 'cart_id');
    }

    public function cartProducts()
    {
        return $this->hasMany(CartProduct::class, 'cart_id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function cartCheckout($cart, $branch_id, $payment_id)
    {

        $gainedPoints = 0;
        $transactionHeader = ProductTransactionHeader::create([
            'user_id' => $cart->user_id,
            'branch_id' => $branch_id,
            'payment_id' => $payment_id
        ]);

        $transactionHeader->save();

        if (!$cart->cartProducts->isEmpty()) {

            foreach ($cart->cartProducts as $cartProduct) {
                // dd($cartProduct->product);
                if ($cartProduct->product && $cartProduct->product_id) {


                    ProductTransactionDetail::create([
                        'product_transaction_id' => $transactionHeader->id,
                        'product_id' => $cartProduct->product_id,
                        'quantity' => $cartProduct->quantity,
                    ]);

                    $productPoints = $cartProduct->product->price * $cartProduct->quantity;
                    $gainedPoints += $productPoints;

                    $cartProduct->delete();
                }
            }
        }

        if (!$cart->cartPackets->isEmpty()) {
            foreach ($cart->cartPackets as $cartPacket) {
                if ($cartPacket->packet && $cartPacket->packet_id) {


                    ProductPacketTransactionDetail::create([
                        'product_transaction_id' => $transactionHeader->id,
                        'packet_id' => $cartPacket->packet_id,
                        'quantity' => $cartPacket->quantity,
                    ]);

                    $packetPoints = $cartPacket->packet->price * $cartPacket->quantity;
                    $gainedPoints += $packetPoints;

                    $cartPacket->delete();
                }
            }
        }

        $cart->user->updateMembershipPoints($gainedPoints);

        return redirect()->route('transaction')->with('success', 'Checkout success');
    }
}
