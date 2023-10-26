<?php

use App\Http\Controllers\PageController\CartPageController;
use App\Http\Controllers\PageController\HomeController;
use App\Http\Controllers\PageController\MenuController;
use App\Http\Controllers\PageController\ProfileController;
use App\Http\Controllers\PageController\TransactionDetailPageController;
use App\Http\Controllers\PageController\TransactionPageController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/menu', [MenuController::class, 'index'])->name('menu');
Route::get('/menu-search', [MenuController::class, 'menuSearch'])->name('menu-search');

Route::middleware(['auth'])->group(function () {
    Route::get('/transaction', [TransactionPageController::class, 'index'])->name('transaction');
    Route::get('/transaction/{id}', [TransactionDetailPageController::class, 'index' ])->name('transaction-detail');
    Route::post('/transaction-change-branch', [TransactionPageController::class, 'index'])->name('transaction-change-branch');

    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::get('/cart', [CartPageController::class, 'index'])->name('cart');

    Route::post('/add-to-cart-packet', [MenuController::class, 'addToCartPacket'])->name('add-to-cart-packet');
    Route::post('/add-to-cart-product', [MenuController::class, 'addToCartProduct'])->name('add-to-cart-product');
    Route::post('/edit-profile', [ProfileController::class, 'editProfile'])->name('edit-profile');

    Route::post('cart-product-decrease/{product_id}', [CartPageController::class, 'cartProductDecrease'])->name('cart-product-decrease');
    Route::post('cart-product-increase/{product_id}', [CartPageController::class, 'cartProductIncrease'])->name('cart-product-increase');
    Route::post('cart-product-remove/{product_id}', [CartPageController::class, 'cartProductRemove'])->name('cart-product-remove');

    Route::post('cart-packet-decrease/{packet_id}', [CartPageController::class, 'cartPacketDecrease'])->name('cart-packet-decrease');
    Route::post('cart-packet-increase/{packet_id}', [CartPageController::class, 'cartPacketIncrease'])->name('cart-packet-increase');
    Route::post('cart-packet-remove/{packet_id}', [CartPageController::class, 'cartPacketRemove'])->name('cart-packet-remove');

    Route::post('cart-checkout/{cart_id}', [CartPageController::class, 'cartCheckout'])->name('cart-checkout');

});
