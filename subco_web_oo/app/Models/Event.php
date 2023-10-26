<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $table = 'events';

    public function products(){
        return $this->belongsToMany(Event::class, 'event_products', 'event_id', 'product_id');
    }
}
