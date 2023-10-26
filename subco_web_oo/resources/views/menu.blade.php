@extends('layouts.app')



@section('content')
    <div class="container-fluid vh-100 ">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fixed-bottom m-0 ">
                {{ session('success') }}
            </div>
        @elseif(session('failed'))
            <div class="alert alert-danger alert-dismissible fixed-bottom  m-0 ">
                {{ session('failed') }}

            </div>
        @endif
        <div class="container py-2">

            <div class="container ">

                <form action="{{ route('menu-search') }}" method="GET" class="mb-4">
                    <div class="input-group  ">
                        <input type="text" class="form-control border-dark-subtle" name="search" placeholder="Search...">
                        <button class="btn btn-outline-secondary " type="submit">Search</button>
                    </div>
                </form>



                @if ($search == 1)

                <h4 class="py-3 fst-italic ">Search results for '{{$query}}'</h4>

                    @foreach ($searchPackets as $packet)
                        <form action={{ route('add-to-cart-packet') }} method="POST">
                            <input type="hidden" name="packet_id" value="{{ $packet->id }}">

                            <div class="card mt-2 mb-4 shadow ">

                                <div class="card-header bg-dark ">

                                    <div class="row">
                                        <div class="col-12">
                                            <h3 class="mt-2 text-white ">Packet: {{ $packet->name }} [${{ $packet->price }}]</h3>

                                        </div>

                                    </div>
                                </div>

                                <div class="card-body ">

                                    <div class="row my-2">
                                        @foreach ($packet->products as $product)
                                            <div class="col-md-3">
                                                @csrf
                                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                <input type="hidden" name="product_quantity"
                                                    value="{{ $product->pivot->quantity }}">
                                                <div class="card">
                                                    <img src="{{ asset('storage/' . $product->image) }}"
                                                        class="card-img-top" alt="{{ $product->name }}"
                                                        style="background-size: cover; height:12.5rem;">
                                                    <div class="card-body">
                                                        <h5 class="card-title">{{ $product->name }}</h5>
                                                        <p class="card-text">Price: ${{ $product->price }}</p>
                                                        <p class="card-text">Quantity: {{ $product->pivot->quantity }}
                                                        </p>
                                                    </div>

                                                </div>
                                            </div>
                                        @endforeach

                                    </div>
                                    <div class="row py-2">
                                        @staff
                                        @else
                                            <div class="col-md-3">
                                                <input id="quantity" type="number"
                                                    class="form-control @error('quantity') is-invalid @enderror"
                                                    name="packet_quantity">
                                                @error('quantity')
                                                    <span class="invalid-feedback d-block text-center" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="col-md-4">
                                                <button type="submit" class="btn btn-primary ">Add to Cart</button>
                                            </div>
                                        @endstaff

                                    </div>
                                </div>
                            </div>
                        </form>
                    @endforeach

                    <div class="row mb-5 ">
                        @foreach ($searchProducts as $product)
                            <div class="col-md-3">
                                <form action="{{ route('add-to-cart-product') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <div class="card">
                                        <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top"
                                            alt="{{ $product->name }}" style="background-size: cover; height:12.5rem;">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $product->name }}</h5>
                                            <p class="card-text">Price: ${{ $product->price }}</p>
                                        </div>
                                        @staff
                                        @else
                                            <div class="card-footer">

                                                <div class="row g-2">
                                                    <div class="col-md-6">
                                                        <input id="quantity" type="number"
                                                            class="form-control @error('quantity') is-invalid @enderror"
                                                            name="product_quantity">
                                                        @error('quantity')
                                                            <span class="invalid-feedback d-block text-center" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <div class="col-md-6">
                                                        <button type="submit" class="btn btn-primary w-100">Add to
                                                            Cart</button>
                                                    </div>
                                                </div>
                                            </div>
                                        @endstaff

                                    </div>
                                </form>
                            </div>
                        @endforeach

                    </div>
                @else
                    <div class="d-flex justify-content-end  fixed-bottom p-4 ms-auto   w-25">
                        {{ $productsType->links('pagination::bootstrap-4') }}
                    </div>

                    @if ($productsType->currentPage() == 1)
                        @foreach ($packets as $packet)
                            <form action={{ route('add-to-cart-packet') }} method="POST">
                                <input type="hidden" name="packet_id" value="{{ $packet->id }}">

                                <div class="card mt-2 mb-4 shadow ">

                                    <div class="card-header bg-dark ">

                                        <div class="row">
                                            <div class="col-12">
                                                <h3 class="mt-2 text-white ">Packet: {{ $packet->name }} [${{ $packet->price }}]
                                                </h3>

                                            </div>

                                        </div>
                                    </div>

                                    <div class="card-body ">

                                        <div class="row my-2">
                                            @foreach ($packet->products as $product)
                                                <div class="col-md-3">
                                                    @csrf
                                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                    <input type="hidden" name="product_quantity"
                                                        value="{{ $product->pivot->quantity }}">
                                                    <div class="card">
                                                        <img src="{{ asset('storage/' . $product->image) }}"
                                                            class="card-img-top" alt="{{ $product->name }}"
                                                            style="background-size: cover; height:12.5rem;">
                                                        <div class="card-body">
                                                            <h5 class="card-title">{{ $product->name }}</h5>
                                                            <p class="card-text">Price: ${{ $product->price }}</p>
                                                            <p class="card-text">Quantity: {{ $product->pivot->quantity }}
                                                            </p>
                                                        </div>

                                                    </div>
                                                </div>
                                            @endforeach

                                        </div>
                                        <div class="row py-2">
                                            @staff
                                            @else
                                                <div class="col-md-3">
                                                    <input id="quantity" type="number"
                                                        class="form-control @error('quantity') is-invalid @enderror"
                                                        name="packet_quantity">
                                                    @error('quantity')
                                                        <span class="invalid-feedback d-block text-center" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-4">
                                                    <button type="submit" class="btn btn-primary ">Add to Cart</button>
                                                </div>
                                            @endstaff

                                        </div>
                                    </div>
                                </div>
                            </form>
                        @endforeach
                    @endif

                    @foreach ($productsType as $productType)
                        <div class="row">
                            {{-- <div class="col-1 rounded-5" style="background-image: linear-gradient(to right top, #d1886b, #d79867, #d9a965, #d5bb68, #cdce70, #cdd472, #ccda74, #cbe077, #d7da6e, #e4d466, #f0ce61, #fbc75f); height: 2rem; width: 1px"></div> --}}
                            <div class="col-6">
                                <h2 class=""># {{ $productType->name }}</h2>
                            </div>
                        </div>

                        <div class="row mb-5 ">
                            @foreach ($productType->products as $product)
                                <div class="col-md-3">
                                    <form action="{{ route('add-to-cart-product') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <div class="card">
                                            <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top"
                                                alt="{{ $product->name }}"
                                                style="background-size: cover; height:12.5rem;">
                                            <div class="card-body">
                                                <h5 class="card-title">{{ $product->name }}</h5>
                                                <p class="card-text">Price: ${{ $product->price }}</p>
                                            </div>
                                            @staff
                                            @else
                                                <div class="card-footer">

                                                    <div class="row g-2">
                                                        <div class="col-md-6">
                                                            <input id="quantity" type="number"
                                                                class="form-control @error('quantity') is-invalid @enderror"
                                                                name="product_quantity">
                                                            @error('quantity')
                                                                <span class="invalid-feedback d-block text-center" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                        <div class="col-md-6">
                                                            <button type="submit" class="btn btn-primary w-100">Add to
                                                                Cart</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endstaff

                                        </div>
                                    </form>
                                </div>
                            @endforeach



                        </div>
                    @endforeach

                @endif


            </div>

        </div>

        <div class="modal fade" id="productModal" tabindex="-1" aria-labelledby="productModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                @guest
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Buy Product</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body text-center ">
                            <h3>Please Login</h3>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <a href={{ route('login') }}>
                                <button type="button" class="btn btn-primary">Login</button>
                            </a>
                        </div>
                    </div>
                @endguest

            </div>
        </div>

    </div>
@endsection
