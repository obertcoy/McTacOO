<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserMembership extends Model
{
    use HasFactory;

    protected $table = 'user_memberships';

    protected $fillable = ['user_id', 'membership_id', 'membership_current_points'];

}
