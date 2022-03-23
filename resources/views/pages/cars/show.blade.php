@extends('layouts.front.layout')

@section('content')
    <div class="container mt-5 mb-md-4 py-5">
        <!-- Breadcrumb-->
        <nav class="mb-3 pt-md-3" aria-label="Breadcrumb">
            <ol class="breadcrumb breadcrumb-light">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('cars.index') }}">Cars</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $car->title }}</li>
            </ol>
        </nav>
        <!-- Title + Sharing-->
        <div class="d-sm-flex align-items-end align-items-md-center justify-content-between position-relative mb-4" style="z-index: 1025;">
            <div class="me-3">
                <h1 class="h2 text-light mb-md-0">{{ $car->title }}</h1>
                @if(session()->has('user'))
                    @if($car->user->id == session()->get('user')->id)
                        <a href="{{ route('cars.edit', ['car' => $car->id]) }}" class="btn btn-primary mt-3">Edit</a>
                        <form action="">
                            <a href="{{ route('cars.destroy', ['car' => $car->id]) }}" data-delete="{{ $car->id }}" id="delete-{{ $car->id }}" class="btn btn-danger mt-3">Delete</a>
                        </form>
                    @endif
                @endif
                <div class="d-md-none">
                    <div class="d-flex align-items-center mb-3">
                        <div class="h3 mb-0 text-light">{{ $car->price }}</div>
                        <div class="text-nowrap ps-3"><span class="badge bg-info fs-base me-2">{{ $car->new }}</span></div>
                    </div>
                    <div class="d-flex flex-wrap align-items-center text-light mb-2">
                        <div class="text-nowrap border-end border-light pe-3 me-3"><i class="fi-dashboard fs-lg opacity-70 me-2"></i><span class="align-middle">{{ $car->mileage }}</span></div>
                        <div class="text-nowrap"><i class="fi-map-pin fs-lg opacity-70 me-2"></i><span class="align-middle">{{ $car->user->location->location }}</span></div>
                    </div>
                </div>
            </div>
            <div class="text-nowrap pt-3 pt-sm-0">
                <button class="btn btn-icon btn-translucent-light btn-xs rounded-circle mb-sm-2" type="button" data-bs-toggle="tooltip" title="Add to Wishlist"><i class="fi-heart"></i></button>

            </div>
        </div>
        <div class="row">
            <div class="col-md-7">
                <!-- Gallery-->
                <div class="tns-carousel-wrapper">
                    <div class="tns-slides-count text-light"><i class="fi-image fs-lg me-2"></i>
                        <div class="ps-1"><span class="tns-current-slide fs-5 fw-bold"></span><span class="fs-5 fw-bold">/</span><span class="tns-total-slides fs-5 fw-bold"></span></div>
                    </div>
                    <div class="tns-carousel-inner" data-carousel-options="{&quot;navAsThumbnails&quot;: true, &quot;navContainer&quot;: &quot;#thumbnails&quot;, &quot;gutter&quot;: 12, &quot;responsive&quot;: {&quot;0&quot;:{&quot;controls&quot;: false},&quot;500&quot;:{&quot;controls&quot;: true}}}">
                        @foreach($car->car_images as $image)
                        <div><img class="rounded-3" src="{{ asset('storage/img/' . $car->user->id . '/' . $image->image) }}" alt="Image"></div>
                        @endforeach

                    </div>
                </div>
                <ul class="tns-thumbnails" id="thumbnails">
                    @foreach($car->car_images as $image)

                    <li class="tns-thumbnail"><img src="{{ asset('storage/img/' . $car->user->id . '/' . $image->image) }}" alt="Thumbnail"></li>
                    @endforeach
                </ul>
                <!-- Specs-->
                <div class="py-3 mb-3">
                    <h2 class="h4 text-light mb-4">Specifications</h2>
                    <div class="row text-light">
                        <div class="col-sm-6 col-md-12 col-lg-6">
                            <ul class="list-unstyled">
                                <li class="mb-2"><strong>Manufacturing Year:</strong><span class="opacity-70 ms-1">{{ $car->year }}</span></li>
                                <li class="mb-2"><strong>Mileage:</strong><span class="opacity-70 ms-1">{{ $car->mileage }} km</span></li>
                                <li class="mb-2"><strong>Body Type:</strong><span class="opacity-70 ms-1">{{ $car->car_type->type }}</span></li>
                                <li class="mb-2"><strong>Drivetrain:</strong><span class="opacity-70 ms-1">{{ $car->drivetrain->drivetrain }}</span></li>
{{--                                <li class="mb-2"><strong>Engine:</strong><span class="opacity-70 ms-1">2.5L Turbo 6 Cylinder</span></li>--}}
                                <li class="mb-2"><strong>Transmission:</strong><span class="opacity-70 ms-1">{{ $car->transmission }}</span></li>
                            </ul>
                        </div>
                        <div class="col-sm-6 col-md-12 col-lg-6">
                            <ul class="list-unstyled">
                                <li class="mb-2"><strong>Fuel Type:</strong><span class="opacity-70 ms-1">{{ $car->gas->gas }}</span></li>
{{--                                <li class="mb-2"><strong>Exterior Color:</strong><span class="opacity-70 ms-1">Aspen White</span></li>--}}
{{--                                <li class="mb-2"><strong>Interior Color:</strong><span class="opacity-70 ms-1">Charcoal</span></li>--}}
{{--                                <li class="mb-2"><strong>VIN:</strong><span class="opacity-70 ms-1">2VW821AU9JM754284</span></li>--}}
                            </ul>
                        </div>
                    </div>
                </div>


                <!-- Description-->
                <div class="pb-4 mb-3">
                    <h2 class="h4 text-light pt-4 mt-3">Seller's car Description</h2>
                    <p class="text-light opacity-70 mb-1">{{ $car->description }}</p>
                </div>
                <!-- Post meta-->
                <div class="d-flex flex-wrap border-top border-light fs-sm text-light pt-4 pb-5 pb-md-2">
                    <div class="border-end border-light pe-3 me-3"><span class="opacity-70">Published: <strong>{{ date('d-m-Y H:i', strtotime($car->created_at)) }}</strong></span></div>
                </div>
            </div>
            <!-- Sidebar-->
            <div class="col-md-5 pt-5 pt-md-0" style="margin-top: -6rem;">
                <div class="sticky-top pt-5">
                    <div class="d-none d-md-block pt-5">
                        <div class="d-flex mb-4"><span class="badge bg-info fs-base me-2">{{ $car->new }}</span></div>
                        <div class="h3 text-light">{{ $car->price }} $</div>
                        <div class="d-flex align-items-center text-light pb-4 mb-2">
                            <div class="text-nowrap border-end border-light pe-3 me-3"><i class="fi-dashboard fs-lg opacity-70 me-2"></i><span class="align-middle">{{ $car->mileage }}km</span></div>
                            <div class="text-nowrap"><i class="fi-map-pin fs-lg opacity-70 me-2"></i><span class="align-middle">{{ $car->user->location->location }}</span></div>
                        </div>
                    </div>
                    <div class="card card-light card-body mb-4">
                        <div class="text-light mb-2">Private Seller</div><a class="d-flex align-items-center text-decoration-none mb-3" href="car-finder-vendor.html"><img class="rounded-circle" src="{{ $car->user->photo != null ? asset('storage/img/' . $car->user->id . '/profile/' . $car->user->photo) : asset('assets/img/default.jpg') }}" width="48" alt="{{ $car->user->first_name }}">
                            <div class="ps-2">
                                <h5 class="text-light mb-0">{{ $car->user->first_name . ' ' . $car->user->last_name }}</h5>
                            </div></a>
                        <div class="pt-4 mt-2">
                            <button class="btn btn-outline-light btn-lg px-4 mb-3" type="button"><i class="fi-phone me-2"></i>{{ $car->user->phone }}</button><br><a class="btn btn-primary btn-lg" href="car-finder-single.html#send-mail" data-bs-toggle="collapse"><i class="fi-chat-left me-2"></i>Email user</a>
                            <div class="collapse" id="send-mail">
                                <form class="needs-validation pt-4" novalidate>
                                    <div class="mb-3">
                                        <textarea class="form-control form-control-light" rows="5" placeholder="Write your message" required></textarea>
                                        <div class="invalid-feedback">Please enter you message.</div>
                                    </div>
                                    <button class="btn btn-outline-primary" type="submit">Send email</button>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- Related posts (Carousel)-->
        <h2 class="h3 text-light pt-5 pb-3 mt-md-4">You may be interested in</h2>
        <div class="tns-carousel-wrapper tns-controls-outside-xxl tns-nav-outside tns-carousel-light">
            <div class="tns-carousel-inner" data-carousel-options="{&quot;items&quot;: 3, &quot;responsive&quot;: {&quot;0&quot;:{&quot;items&quot;:1, &quot;gutter&quot;: 16},&quot;500&quot;:{&quot;items&quot;:2, &quot;gutter&quot;: 18},&quot;900&quot;:{&quot;items&quot;:3, &quot;gutter&quot;: 20}, &quot;1100&quot;:{&quot;gutter&quot;: 24}}}">\
                @foreach(\App\Models\Car::orderBy('price', 'desc')->take(5)->get() as $one)
                    <div>
                        <div class="card card-light card-hover h-100">
                            <div class="card-img-top card-img-hover"><a class="img-overlay" href="{{ route('cars.show', ['car' => $one->id]) }}"></a>
                                <div class="position-absolute start-0 top-0 pt-3 ps-3"><span class="d-table badge bg-danger">{{ $one->new }}</span></div>
                                <div class="content-overlay end-0 top-0 pt-3 pe-3">
                                    <button class="btn btn-icon btn-light btn-xs text-primary rounded-circle" type="button" data-bs-toggle="tooltip" data-bs-placement="left" title="Add to Wishlist"><i class="fi-heart"></i></button>
                                </div><img src="{{ asset('storage/img/' . $one->user->id . '/' . $one->car_images[0]->image) }}" alt="{{ $one->title }}">
                            </div>
                            <div class="card-body">
                                <div class="d-flex align-items-center justify-content-between pb-1"><span class="fs-sm text-light me-3">{{ $one->year }}</span>

                                </div>
                                <h3 class="h6 mb-1"><a class="nav-link-light" href="{{ route('cars.show', ['car' => $one->id]) }}">{{ $one->title }}</a></h3>
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
                    </div>
                @endforeach

            </div>
        </div>
    </div>


@endsection

@section('scripts')
    <script>
        const deleteBtn = document.getElementById('delete-{{ $car->id }}');
        deleteBtn.addEventListener('click', (e) => {
            e.preventDefault();
            console.log( e.target.getAttribute('data-delete'));
            if(confirm("Are you sure you want to delete?")) {
                fetch('/cars/' + e.target.getAttribute('data-delete'), {
                    headers: {
                        "Accept": "application/json",
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    method: "delete"
                });
            }
        })
    </script>
{{--    <script src="{{ asset('assets/js/main.js') }}"></script>--}}
@endsection
