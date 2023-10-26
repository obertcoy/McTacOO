@extends('layouts.app')

@section('content')
    <div class="container-fluid vh-100 px-0 pb-0">

        <div class="container h-75 w-75 my-4 border p-3 shadow rounded-3 ">

            <div id="home-promo-carousel" class="carousel slide h-100  " data-bs-ride="#carousel">
                <div class="carousel-indicators">
                    @foreach ($promos as $index => $promo)
                        <button type="button" data-bs-target="#home-promo-carousel" data-bs-slide-to="{{ $index }}"
                            class="{{ $index === 0 ? 'active' : '' }} bg-dark"
                            aria-current="{{ $index === 0 ? 'true' : 'false' }}"
                            aria-label="Slide {{ $index + 1 }}"></button>
                    @endforeach
                </div>
                <div class="carousel-inner h-100">
                    @foreach ($promos as $index => $promo)
                        <div class="carousel-item {{ $index === 0 ? 'active' : '' }} h-100">
                            <img src="{{ asset('storage/' . $promo->image) }}" class="object-fit-fill w-100 h-100 rounded "
                                alt="{{ $promo->name }}">
                            <div class="carousel-caption d-none d-md-block">
                                <h2 class="font-weight-bold text-light fw-bold  ">{{ $promo->name }}</h2>
                                <p class="">{{ $promo->condition }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#home-promo-carousel"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#home-promo-carousel"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>

        <h2 class="text-center mt-5 text-dark  fw-bold fst-italic ">Satisfy Your Cravings!</h2>

        <div class="container-fluid px-0  pt-4">
            <div class="row g-0">
                <div class="col col-md-6">
                    <div class="card text-center h-100">
                        <a href="{{ route('menu') }}" class="text-decoration-none text-black ">

                            <div class="card-body"
                                style="background-image: url('{{ asset('storage/images/fried_chicken.jpg') }}'); background-size: cover; height:12rem; ">
                                <h3 class="card-title text-white fw-bold mt-2">Meals</h3>
                                <p class="card-text text-white">Discover our delicious meal options that will satisfy your
                                    hunger and cravings.</p>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col col-md-6">
                    <div class="card text-center ">
                        <a href="{{ route('menu') }}" class="text-decoration-none text-black ">

                            <div class="card-body"
                                style="background-image: url('{{ asset('storage/images/onion_rings.jpg') }}'); background-size: cover; height:12rem;">
                                <h3 class="card-title text-white fw-bold mt-2">Snacks</h3>
                                <p class="card-text text-white">Treat yourself to our delicious snacks, perfect for
                                    satisfying your mid-day
                                    cravings.</p>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col col-md-6">
                    <div class="card text-center ">
                        <a href="{{ route('menu') }}" class="text-decoration-none text-black ">

                            <div class="card-body"
                                style="background-image: url('{{ asset('storage/images/ice_tea.jpg') }}'); background-size: cover; height:12rem;">
                                <h3 class="card-title text-white fw-bold mt-2">Drinks</h3>
                                <p class="card-text text-white">Quench your thirst with our refreshing drink options,
                                    perfect for any
                                    occasion.
                                </p>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col col-md-6">
                    <div class="card text-center ">
                        <a href="{{ route('menu') }}" class="text-decoration-none text-black ">

                            <div class="card-body"
                                style="background-image: url('{{ asset('storage/images/chocolate_sundae.jpg') }}'); background-size: cover; height:12rem;">
                                <h3 class="card-title text-white fw-bold mt-2">Dessert</h3>
                                <p class="card-text text-white">Indulge your sweet tooth with our mouthwatering dessert
                                    options that will
                                    satisfy your cravings.</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
