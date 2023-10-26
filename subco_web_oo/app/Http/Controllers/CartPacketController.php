<?php

namespace App\Http\Controllers;

use App\Models\Cart\CartPacket;
use Illuminate\Http\Request;

class CartPacketController extends Controller
{
    private $cartPacketModel;

    public function __construct(CartPacket $cartPacketModel)
    {
        $this->cartPacketModel = $cartPacketModel;
    }
    public function addToCartPacket($packet_id, $quantity, $user){
        return $this->cartPacketModel->addToCartPacket($packet_id, $quantity, $user);
    }

    public function cartPacketDecrease($cart, $packet_id){
        return $this->cartPacketModel->cartPacketDecrease($cart, $packet_id);;
    }

    public function cartPacketIncrease($cart, $packet_id){
        return $this->cartPacketModel->cartPacketIncrease($cart, $packet_id);;
    }
    public function cartPacketRemove($cart, $packet_id){
        return $this->cartPacketModel->cartPacketRemove($cart, $packet_id);;
    }
}
