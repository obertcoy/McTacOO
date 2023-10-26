<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;

    protected $table = 'branches';

    public function products()
    {
        return $this->belongsToMany(Product::class, 'branch_products', 'branch_id', 'product_id')
            ->withPivot('quantity');
    }
}
