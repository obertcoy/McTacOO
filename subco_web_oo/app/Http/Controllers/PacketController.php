<?php

namespace App\Http\Controllers;

use App\Models\Packet;
use Illuminate\Http\Request;

class PacketController extends Controller
{
    public function getAllPackets(){
        return Packet::all();
    }

    public function getPacket($id){
        return Packet::find($id);
    }

    public function searchPacket($query){
        return Packet::where('name', 'like', '%' . $query . '%')->get();
    }



}
