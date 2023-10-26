<?php

namespace App\Models;

use App\Models\Cart\Cart;
use App\Models\ProductTransaction\ProductTransactionHeader;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'users';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'name',
        'email',
        'username',
        'password',
        'role_id',
        'membership_id',
        'membership_points'
    ];

    // Define any relationships or other methods here

    // Example: Define a relationship with the 'roles' table
    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    public function membership()
    {
        return $this->belongsTo(Membership::class, 'membership_id');
    }

    public function cart(){
        return $this->hasOne(Cart::class);
    }

    public function isStaff(){
        return $this->role_id == '1';
    }

    public function productTransactions(){
        return $this->hasMany(ProductTransactionHeader::class);
    }

    public function getCurrentUser(){
        return auth()->user();
    }

    public function updateMembershipPoints($points){

        /** @var User|null $user */
        $user= $this->getCurrentUser();
        if($user){

            $user->membership_points += $points;
            $last_membership_id = Membership::orderBy('id', 'desc')->first()->id;

            if($user->membership_points >= $user->membership->required_points && $user->membership_id < $last_membership_id){
                $user->membership_id += 1;
            }

            $user->save();
        }
        return;
    }

    public function updateUser(Request $request, $id){

        $user = User::findOrFail($id);

        if(!$user) return $user;

        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;

        $user->save();

        return $user;
    }

    public function registerUser(array $data){

        $email_ending = explode('@', $data['email'])[1];
        $role = ($email_ending === 'staff.com') ? 'Staff' : 'Customer';
        $roleID = Role::where('name', $role)->value('id');

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'username' => $data['username'],
            'password' => Hash::make($data['password']),
            'role_id' => $roleID,
            'membership_id' => 1,
            'membership_points' => 0
        ]);

        $user->cart()->create([]);

        return $user;
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
