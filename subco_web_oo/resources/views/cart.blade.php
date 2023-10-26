@extends('layouts.app')

@section('content')
    <div class="container vh-100 ">
        <h1>{{ auth()->user()->name }}'s Cart</h1>

        @if ($carts && ($carts->cartProducts->count() > 0 || $carts->cartPackets->count() > 0))
        <table class="table table-striped  mx-auto">
                <thead>
                    <tr>
                        <th>Product Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($carts->cartProducts as $cartProduct)
                        <tr>
                            <td class="align-middle">
                                <div class="d-flex flex-column my-2">
                                    <div class="p-1">
                                        <img src="{{ asset('storage/' . $cartProduct->product->image) }}"
                                            class="rounded shadow-sm shadow " alt="{{ $cartProduct->product->name }}"
                                            style="background-size: cover; height:6.5rem; width:6.5rem;">
                                    </div>
                                    <span class="ms-2 "> {{ $cartProduct->product->name }}</span>


                                </div>
                            </td>

                            <td class="align-middle">${{ $cartProduct->product->price }}</td>
                            <td class="align-middle">
                                <div class="input-group w-25 ">
                                    <form
                                        action="{{ route('cart-product-decrease', ['product_id' => $cartProduct->product->id]) }}"
                                        method="POST">
                                        @csrf
                                        <button type="submit" class="btn-primary btn h-100">-</button>
                                    </form> <input type="number" class="form-control" value="{{ $cartProduct->quantity }}"
                                        readonly>
                                    <form
                                        action="{{ route('cart-product-increase', ['product_id' => $cartProduct->product->id]) }}"
                                        method="POST">
                                        @csrf
                                        <button type="submit" class="btn-primary btn h-100">+</button>
                                    </form>
                                </div>
                            </td>
                            <td class="align-middle">${{ $cartProduct->quantity * $cartProduct->product->price }}</td>
                            <td class="align-middle">
                                <form
                                    action="{{ route('cart-product-remove', ['product_id' => $cartProduct->product->id]) }}"
                                    method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-danger">Remove</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach

                    @foreach ($carts->cartPackets as $cartPacket)
                        <tr>
                            <td class="align-middle">Packet: {{ $cartPacket->packet->name }}</td>
                            <td class="align-middle">${{ $cartPacket->packet->price }}</td>
                            <td class="align-middle">
                                <div class="input-group w-25">
                                    <form
                                        action="{{ route('cart-packet-decrease', ['packet_id' => $cartPacket->packet->id]) }}"
                                        method="POST">
                                        @csrf
                                        <button type="submit" class="btn-primary btn h-100">-</button>
                                    </form>
                                    <input type="number" class="form-control" value="{{ $cartPacket->quantity }}"
                                        readonly>
                                    <form
                                        action="{{ route('cart-packet-increase', ['packet_id' => $cartPacket->packet->id]) }}"
                                        method="POST">
                                        @csrf
                                        <button type="submit" class="btn-primary btn h-100">+</button>
                                    </form>
                                </div>
                            </td>
                            <td class="align-middle">${{ $cartPacket->quantity * $cartPacket->packet->price }}</td>
                            <td class="align-middle">
                                <form action="{{ route('cart-packet-remove', ['packet_id' => $cartPacket->packet->id]) }}"
                                    method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-danger">Remove</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="container-fluid d-flex justify-content-end py-4  ">
                <form action="{{ route('cart-checkout', ['cart_id' => $carts->id]) }}" method="POST">
                    @csrf

                    <div class="row gap-3 d-flex justify-content-end">

                        <div class="col-md-10">
                            <div class="form-group">
                                <label for="branch_id">Select Branch:</label>
                                <select class="form-control" id="branch_id" name="branch_id">
                                    @foreach ($branches as $branch)
                                        <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-10">
                            <div class="form-group">
                                <label for="payment_id">Select Payment:</label>
                                <select class="form-control" id="payment_id" name="payment_id">
                                    @foreach ($payments as $payment)
                                        <option value="{{ $payment->id }}">{{ $payment->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-12 d-flex justify-content-end py-2 ">
                            <button type="submit" class="btn btn-success">Checkout</button>

                        </div>
                    </div>

                </form>
            </div>
        @else
            <p>No product found.</p>
        @endif



    </div>
@endsection
