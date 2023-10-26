<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Membership extends Model
{
    use HasFactory;

    protected $table = 'memberships';

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_memberships', 'membership_id', 'user_id')
            ->withPivot('membership_current_points');
    }

}
