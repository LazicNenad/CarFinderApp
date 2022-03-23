@extends('layouts.front.layout')


@section('content')
    <!-- Page content-->
    <!-- Hero + Search form-->
    <section class="bg-top-center bg-repeat-0 pt-5" style="background-image: url('{{ asset('assets/img/car-finder/home/hero-bg.png') }}'); background-size: 1920px 630px;">
        <div class="container pt-5">
            <div class="row pt-lg-4 pt-xl-5">
                <div class="col-lg-4 col-md-5 pt-3 pt-md-4 pt-lg-5">
                    <h1 class="display-4 text-light pb-2 mb-4 me-md-n5">Easy way to find the right car</h1>
                    <p class="fs-lg text-light opacity-70">Finder is a leading digital marketplace for the automotive industry that connects car shoppers with sellers. </p>
                </div>
                <div class="col-lg-8 col-md-7 pt-md-5"><img class="d-block mt-4 ms-auto" src="{{ asset('assets/img/car-finder/home/hero-img.png') }}" width="800" alt="Car"></div>
            </div>
        </div>
        <div class="container mt-4 mt-sm-3 mt-lg-n3 pb-5 mb-md-4">
        </div>
    </section>

    <!-- Top offers-->
    <section class="container pt-sm-1 pb-5 mb-md-4">
        <div class="d-sm-flex align-items-center justify-content-between mb-4 pb-sm-2">
            <h2 class="h3 text-light mb-2 mb-sm-0">Top offers</h2><a class="btn btn-link btn-light fw-normal px-0" href="{{ route('cars.index') }}">View all offers<i class="fi-arrow-long-right fs-sm mt-0 ps-1 ms-2"></i></a>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <!-- Item-->
                @foreach(\App\Models\Car::inRandomOrder()->take(1)->get() as $one)
                    <div class="card card-light card-hover h-lg-100 mb-4 mb-lg-0">
                        <div class="tns-carousel-wrapper card-img-top card-img-hover"><a class="img-overlay" href="{{ route('cars.show', ['car' => $one->id]) }}"></a>
                            <div class="position-absolute start-0 top-0 pt-3 ps-3"><span class="d-table badge bg-info mb-1">{{ $one->new }}</span></div>
                            <div class="content-overlay end-0 top-0 pt-3 pe-3">
                                <button class="btn btn-icon btn-light btn-xs text-primary rounded-circle" type="button" data-bs-toggle="tooltip" data-bs-placement="left" title="Add to Wishlist"><i class="fi-heart"></i></button>
                            </div>
                            <div class="tns-carousel-inner">
                                @foreach($one->car_images as $image)
                                    <img src="{{ asset('storage/img/' . $one->user->id . '/' . $image->image) }}" alt="Image">
                                @endforeach
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between pb-1"><span class="fs-sm text-light me-3">{{ $one->year }}</span>
                            </div>
                            <h3 class="h6 mb-1"><a class="nav-link-light" href="car-finder-single.html">{{ $one->title }}</a></h3>
                            <div class="text-primary fw-bold mb-1">{{ $one->price }} $</div>
                            <div class="fs-sm text-light opacity-70"><i class="fi-map-pin me-1"></i>{{ $one->user->location->location }}</div>
                        </div>
                        <div class="card-footer border-0 pt-0">
                            <div class="border-top border-light pt-3">
                                <div class="row g-2">
                                    <div class="col me-sm-1">
                                        <div class="bg-dark rounded text-center w-100 h-100 p-2"><i class="fi-dashboard d-block h4 text-light mb-0 mx-center"></i><span class="fs-xs text-light">{{ $one->mileage }}km</span></div>
                                    </div>
                                    <div class="col me-sm-1">
                                        <div class="bg-dark rounded text-center w-100 h-100 p-2"><i class="fi-gearbox d-block h4 text-light mb-0 mx-center"></i><span class="fs-xs text-light">{{ $one->transmission }}</span></div>
                                    </div>
                                    <div class="col">
                                        <div class="bg-dark rounded text-center w-100 h-100 p-2"><i class="fi-petrol d-block h4 text-light mb-0 mx-center"></i><span class="fs-xs text-light">{{ $one->gas->gas }}</span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
            <div class="col-lg-6">
                @foreach(\App\Models\Car::inRandomOrder()->take(2)->get() as $one)
                    <!-- Item-->
                        <div class="card card-light card-hover card-horizontal mb-4">
                            <div class="tns-carousel-wrapper card-img-top card-img-hover"><a class="img-overlay" href="{{ route('cars.show', ["car" => $one->id]) }}"></a>
                                <div class="position-absolute start-0 top-0 pt-3 ps-3"><span class="d-table badge bg-info">{{ $one->new }}</span></div>
                                <div class="content-overlay end-0 top-0 pt-3 pe-3">
                                    <button class="btn btn-icon btn-light btn-xs text-primary rounded-circle" type="button" data-bs-toggle="tooltip" data-bs-placement="left" title="Add to Wishlist"><i class="fi-heart"></i></button>
                                </div>
                                <div class="tns-carousel-inner position-absolute top-0 h-100">
                                    @foreach($one->car_images as $image)
                                    <div class="bg-size-cover bg-position-center w-100 h-100" style="background-image: url('{{ asset('storage/img/' . $one->user->id . '/' . $image->image) }}');"></div>
                                    @endforeach

                                </div>
                            </div>
                            <div class="card-body">
                                <div class="d-flex align-items-center justify-content-between pb-1"><span class="fs-sm text-light me-3">{{ $one->year }}</span>
                                </div>
                                <h3 class="h6 mb-1"><a class="nav-link-light" href="{{ route('cars.show', ['car' => $one->id]) }}">{{ $one->title }}</a></h3>
                                <div class="text-primary fw-bold mb-1">{{ $one->price }} $</div>
                                <div class="fs-sm text-light opacity-70"><i class="fi-map-pin me-1"></i>{{ $one->user->location->location }}</div>
                                <div class="border-top border-light mt-3 pt-3">
                                    <div class="row g-2">
                                        <div class="col me-sm-1">
                                            <div class="bg-dark rounded text-center w-100 h-100 p-2"><i class="fi-dashboard d-block h4 text-light mb-0 mx-center"></i><span class="fs-xs text-light">{{ $one->mileage }}km</span></div>
                                        </div>
                                        <div class="col me-sm-1">
                                            <div class="bg-dark rounded text-center w-100 h-100 p-2"><i class="fi-gearbox d-block h4 text-light mb-0 mx-center"></i><span class="fs-xs text-light">{{ $one->transmission }}</span></div>
                                        </div>
                                        <div class="col">
                                            <div class="bg-dark rounded text-center w-100 h-100 p-2"><i class="fi-petrol d-block h4 text-light mb-0 mx-center"></i><span class="fs-xs text-light">{{ $one->gas->gas }}</span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                @endforeach


            </div>
        </div>
    </section>
    <!-- Features-->
    <section class="container pt-4 pt-md-5">
        <div class="d-sm-flex align-items-center justify-content-between">
            <h2 class="h3 text-light mb-2 mb-sm-0">What sets Finder apart?</h2>
        </div>
        <div class="row">
            <div class="col-md-5 col-lg-4 offset-lg-1 pt-4 mt-2 pt-md-5 mt-md-3">
                <div class="d-flex pb-4 pb-md-5 mb-2"><i class="fi-file lead text-primary mt-1 order-md-2"></i>
                    <div class="text-md-end ps-3 ps-md-0 pe-md-3 order-md-1">
                        <h3 class="h6 text-light mb-1">Over 1 Million Listings</h3>
                        <p class="fs-sm text-light opacity-70 mb-0">That’s more than you’ll find on any other major online automotive marketplace in the USA.</p>
                    </div>
                </div>
                <div class="d-flex pb-4 pb-md-5 mb-2"><i class="fi-search lead text-primary mt-1 order-md-2"></i>
                    <div class="text-md-end ps-3 ps-md-0 pe-md-3 order-md-1">
                        <h3 class="h6 text-light mb-1">Personalized Search</h3>
                        <p class="fs-sm text-light opacity-70 mb-0">Our powerful search makes it easy to personalize your results so you only see the cars and features you care about.</p>
                    </div>
                </div>
                <div class="d-flex pb-4 pb-md-5 mb-2"><i class="fi-settings lead text-primary mt-1 order-md-2"></i>
                    <div class="text-md-end ps-3 ps-md-0 pe-md-3 order-md-1">
                        <h3 class="h6 text-light mb-1">Non-Stop Innovation</h3>
                        <p class="fs-sm text-light opacity-70 mb-0">Our team is constantly developing new features that make the process of buying and selling a car simpler.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-2 d-none d-md-block">
                <div class="position-relative mx-auto h-100" style="max-width: 5rem; min-height: 26rem;">
                    <div class="content-overlay pt-5" data-jarallax-element="100"><img class="pt-3 mt-5" src="{{ asset('assets/img/car-finder/home/car.svg') }}" alt="Car"></div>
                    <div class="position-absolute top-0 start-50 translate-middle-x h-100 overflow-hidden"><img src="{{asset('assets/img/car-finder/home/road-line.svg')}}" width="2" alt="Road line"></div>
                </div>
            </div>
            <div class="col-md-5 col-lg-4 pt-md-5 mt-md-3">
                <div class="d-flex pb-4 pb-md-5 mb-2"><i class="fi-info-circle lead text-primary mt-1"></i>
                    <div class="ps-3">
                        <h3 class="h6 text-light mb-1">Valuable Insights</h3>
                        <p class="fs-sm text-light opacity-70 mb-0">We provide free access to key info like dealer reviews, market value, price drops.</p>
                    </div>
                </div>
                <div class="d-flex pb-4 pb-md-5 mb-2"><i class="fi-users lead text-primary mt-1"></i>
                    <div class="ps-3">
                        <h3 class="h6 text-light mb-1">Consumer-First Mentality</h3>
                        <p class="fs-sm text-light opacity-70 mb-0">We focus on building the most transparent, trustworthy experience for our users, and we’ve proven that works for dealers, too.</p>
                    </div>
                </div>
                <div class="d-flex pb-4 pb-md-5 mb-2"><i class="fi-calculator lead text-primary mt-1"></i>
                    <div class="ps-3">
                        <h3 class="h6 text-light mb-1">Online Car Appraisal</h3>
                        <p class="fs-sm text-light opacity-70 mb-0">Specify the parameters of your car to form its market value on the basis of similar cars on Finder.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Latest cars (carousel)-->
    <section class="container pt-sm-5 pt-4 pb-3">
        <div class="d-sm-flex align-items-center justify-content-between mb-3 mb-sm-4 pb-2">
            <h2 class="h3 text-light mb-3 mb-sm-0">Latest cars</h2>
            <div class="d-flex align-items-center">
                <a class="btn btn-link btn-light fw-normal px-0" href="{{ route('cars.index') }}">View all<i class="fi-arrow-long-right fs-sm mt-0 ps-1 ms-2"></i></a>
            </div>
        </div>
        <div class="tns-carousel-wrapper tns-controls-outside-xxl tns-nav-outside tns-carousel-light">
            <div class="tns-carousel-inner" data-carousel-options="{&quot;items&quot;: 3, &quot;responsive&quot;: {&quot;0&quot;:{&quot;items&quot;:1, &quot;gutter&quot;: 16},&quot;500&quot;:{&quot;items&quot;:2, &quot;gutter&quot;: 18},&quot;900&quot;:{&quot;items&quot;:3, &quot;gutter&quot;: 20}, &quot;1100&quot;:{&quot;gutter&quot;: 24}}}">
                @foreach(\App\Models\Car::take(4)->orderBy('created_at', 'desc')->get() as $one)
                <div>
                    <div class="card card-light card-hover h-100">
                        <div class="card-img-top card-img-hover"><a class="img-overlay" href="{{ route('cars.show', ['car' => $one->id]) }}"></a>
                            <div class="position-absolute start-0 top-0 pt-3 ps-3"><span class="d-table badge bg-info">{{ $one->new }}</span></div>
                            <div class="content-overlay end-0 top-0 pt-3 pe-3">
                                <button class="btn btn-icon btn-light btn-xs text-primary rounded-circle" type="button" data-bs-toggle="tooltip" data-bs-placement="left" title="Add to Wishlist"><i class="fi-heart"></i></button>
                            </div><img src="{{ asset('storage/img/' . $one->user->id . '/' . $one->car_images[0]->image) }}" alt="Image">
                        </div>
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between pb-1"><span class="fs-sm text-light me-3">{{ $one->year }}</span>
                            </div>
                            <h3 class="h6 mb-1"><a class="nav-link-light" href="{{ route('cars.index', ['car' => $one->id]) }}">{{ $one->title }}</a></h3>
                            <div class="text-primary fw-bold mb-1">{{ $one->price }} $</div>
                            <div class="fs-sm text-light opacity-70"><i class="fi-map-pin me-1"></i>{{ $one->user->location->location }}</div>
                        </div>
                        <div class="card-footer border-0 pt-0">
                            <div class="border-top border-light pt-3">
                                <div class="row g-2">
                                    <div class="col me-sm-1">
                                        <div class="bg-dark rounded text-center w-100 h-100 p-2"><i class="fi-dashboard d-block h4 text-light mb-0 mx-center"></i><span class="fs-xs text-light">{{ $one->mileage }} km</span></div>
                                    </div>
                                    <div class="col me-sm-1">
                                        <div class="bg-dark rounded text-center w-100 h-100 p-2"><i class="fi-gearbox d-block h4 text-light mb-0 mx-center"></i><span class="fs-xs text-light">{{ $one->transmission }}</span></div>
                                    </div>
                                    <div class="col">
                                        <div class="bg-dark rounded text-center w-100 h-100 p-2"><i class="fi-petrol d-block h4 text-light mb-0 mx-center"></i><span class="fs-xs text-light">{{ $one->gas->gas }}</span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

@endsection






