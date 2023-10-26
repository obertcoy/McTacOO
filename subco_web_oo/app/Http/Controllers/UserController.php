<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UserController extends Controller
{

    private $userModel;

    public function __construct(User $userModel)
    {
        $this->userModel = $userModel;
    }

    public function getCurrentUser(){
        return $this->userModel->getCurrentUser();
    }

    public function updateUser(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users', 'email')->ignore($id)],
            'username' => ['required', 'string', 'max:255', Rule::unique('users', 'username')->ignore($id)],
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        return $this->userModel->updateUser($request, $id);
    }

    public function updateMembershipPoints($points){
        if($points <= 0) return;

        return $this->userModel->updateMembershipPoints($points);
    }
}
