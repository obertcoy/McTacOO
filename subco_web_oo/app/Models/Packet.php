<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Packet extends Model
{
    use HasFactory;

    public function products(){
        return $this->belongsToMany(Product::class, 'packet_products', 'packet_id', 'product_id')->withPivot('quantity');
    }

}
