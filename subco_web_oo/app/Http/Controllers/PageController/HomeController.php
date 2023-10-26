<?php

namespace App\Http\Controllers\PageController;

use App\Http\Controllers\Controller;
use App\Http\Controllers\PromoController;
use App\Models\Product;
use App\Models\Promo;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $promoController = new PromoController();
        $promos = $promoController->getAllPromo();

        return view('home', ['promos' => $promos]);
    }
}
