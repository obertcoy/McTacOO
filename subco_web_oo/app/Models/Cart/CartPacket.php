<?php

namespace App\Models\Cart;

use App\Models\Packet;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CartPacket extends Model
{
    use HasFactory;

    protected $table = 'cart_packets';
    protected $primaryKey = 'cart_id';
    protected $fillable = ['packet_id', 'quantity'];


    public function cart(){
        return $this->belongsTo(Cart::class);
    }

    public function packet()
    {
        return $this->belongsTo(Packet::class, 'packet_id');
    }

    public function addToCartPacket($packet_id, $quantity, $user)
    {
        $cart = $user->cart;

        $existingPacket = $cart->cartPackets()->where('packet_id', $packet_id)->first();

        if ($existingPacket) {
            DB::table('cart_packets')
            ->where('cart_id', $cart->id)
            ->where('packet_id', $packet_id)
            ->update(['quantity' => $existingPacket->quantity + $quantity]);
        } else {
            $cart->cartPackets()->create([
                'packet_id' => $packet_id,
                'quantity' => $quantity,
            ]);
        }

        return redirect()->back()->with('success', 'Packet added to cart');
    }

    public function cartPacketDecrease($cart, $packet_id){
        $cartPacket = $cart->cartPackets()->where('packet_id', $packet_id)->first();
        if ($cartPacket) {
            $newQuantity = max($cartPacket->quantity - 1, 0);

            DB::table('cart_packets')
                ->where('cart_id', $cart->id)
                ->where('packet_id', $packet_id)
                ->update(['quantity' => $newQuantity]);

            if ($newQuantity === 0) {
                DB::table('cart_packets')
                ->where('cart_id', $cart->id)
                ->where('packet_id', $packet_id)
                ->delete();
            }

            return response()->json(['message' => 'Quantity decreased successfully', 'cartPacket' => $cartPacket]);
        }
    }

    public function cartPacketIncrease($cart, $packet_id){
        $cartPacket = $cart->cartPackets()->where('packet_id', $packet_id)->first();
        if ($cartPacket) {

            DB::table('cart_packets')
                ->where('cart_id', $cart->id)
                ->where('packet_id', $packet_id)
                ->update(['quantity' => $cartPacket->quantity + 1]);

            return response()->json(['message' => 'Quantity increased successfully', 'cartPacket' => $cartPacket]);
        }

        return $cartPacket;
    }

    public function cartPacketRemove($cart, $packet_id){
        $cartPacket = $cart->cartPackets()->where('packet_id', $packet_id)->first();
        if ($cartPacket) {

            DB::table('cart_packets')
                ->where('cart_id', $cart->id)
                ->where('packet_id', $packet_id)
                ->delete();

                return response()->json(['message' => ' removed']);
            }

        return $cartPacket;
    }
}
