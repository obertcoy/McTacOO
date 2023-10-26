<?php

namespace App\Http\Controllers\PageController;

use App\Http\Controllers\Controller;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;

class ProfileController extends Controller
{

    private $userController;

    public function __construct(UserController $userController)
    {
        $this->userController = $userController;
    }

    public function index(){

        $currUser = $this->userController->getCurrentUser();

        return view('profile', ['user' => $currUser]);
    }

    public function editProfile(Request $request){

        // dd($request);

        if(!$this->userController->updateUser($request, auth()->user()->id)) return redirect()->back()->with('failed', 'Profile update failed');

        return redirect()->back()->with('success', 'Profile updated successfully');
    }
}
