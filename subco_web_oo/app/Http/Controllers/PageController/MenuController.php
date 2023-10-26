<?php

namespace App\Http\Controllers\PageController;

use App\Http\Controllers\CartPacketController;
use App\Http\Controllers\CartProductController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\PacketController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductTypeController;
use App\Models\Product;
use Illuminate\Http\Request;

class MenuController extends Controller
{

    private $productTypeController;
    private $productController;
    private $packetController;
    private $cartProductController;
    private $cartPacketController;


    public function __construct(ProductTypeController $productTypeController, ProductController $productController, PacketController $packetController, CartProductController $cartProductController, CartPacketController $cartPacketController)
    {
        $this->productTypeController = $productTypeController;
        $this->productController = $productController;
        $this->packetController = $packetController;
        $this->cartProductController = $cartProductController;
        $this->cartPacketController = $cartPacketController;
    }

    public function index(){

        $productsBasedOnType = $this->productTypeController->getAllProductsBasedOnType();
        $packets = $this->packetController->getAllPackets();
        // dd($packets);

        return view('menu', ['productsType' => $productsBasedOnType, 'packets' => $packets, 'search' => 0]);
    }

    public function menuSearch(Request $request){

        $query = $request->search;
        if(!$query || $query == ' ') return $this->index();

        $searchProducts = $this->productController->searchProduct($query);
        $searchPackets = $this->packetController->searchPacket($query);

        return view('menu', ['searchProducts' => $searchProducts, 'searchPackets' => $searchPackets, 'search' => 1 , 'query' => $query]);
    }

    public function addToCartProduct(Request $request){

        if($request->product_quantity <= 0 || $request->product_quantity == null) return redirect()->back()->with('failed', 'Quantity must be more than 0');

        $product = $this->productController->getProduct($request->product_id);

        if(!$product) return redirect()->back()->with('failed', 'Product not found');

        return $this->cartProductController->addToCartProduct($product->id, $request->product_quantity, auth()->user());
    }

    public function addToCartPacket(Request $request){

        if($request->packet_quantity <= 0 || $request->packet_quantity == null) return redirect()->back()->with('failed', 'Quantity must be more than 0');

        $packet= $this->packetController->getPacket($request->packet_id);

        if(!$packet) return redirect()->back()->with('failed', 'Product not found');

        return $this->cartPacketController->addToCartPacket($packet->id, $request->packet_quantity, auth()->user());
    }
}
