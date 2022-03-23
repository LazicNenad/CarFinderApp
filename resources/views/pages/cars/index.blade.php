@extends('layouts.front.layout')

@section('content')
    <!-- Page content-->
    <!-- Page container-->
    <div class="container mt-5 mb-md-4 py-5">
        <div class="row py-md-1">
            <!-- Filers sidebar (Offcanvas on mobile)-->
            <div class="col-lg-3 pe-xl-4">
                <div class="offcanvas offcanvas-start offcanvas-collapse bg-dark" id="filters-sidebar">
                    <div class="offcanvas-header bg-transparent d-flex d-lg-none align-items-center">
                        <h2 class="h5 text-light mb-0">Filters</h2>
                        <button class="btn-close btn-close-white" type="button" data-bs-dismiss="offcanvas"></button>
                    </div>

                    <div class="offcanvas-body py-lg-4">
{{--                        <div class="pb-3 mb-4 border-bottom border-light">--}}
{{--                            <div class="d-flex align-items-center justify-content-between mb-3">--}}
{{--                                <h3 class="h6 text-light mb-0">Selection</h3>--}}
{{--                                <button class="btn btn-link btn-light fw-normal fs-sm p-0" type="button">Clear all</button>--}}
{{--                            </div>--}}
{{--                            <ul class="nav nav-pills nav-pills-light flex-row fs-sm mx-0">--}}
{{--                                <li class="nav-item mb-2 me-2">--}}
{{--                                    <button class="nav-link px-3" type="button">Under 2019<i class="fi-x fs-xxs ms-2"></i></button>--}}
{{--                                </li>--}}
{{--                                <li class="nav-item mb-2 me-2">--}}
{{--                                    <button class="nav-link px-3">Crossover<i class="fi-x fs-xxs ms-2"></i></button>--}}
{{--                                </li>--}}
{{--                                <li class="nav-item mb-2 me-2">--}}
{{--                                    <button class="nav-link px-3" type="button">Sedan<i class="fi-x fs-xxs ms-2"></i></button>--}}
{{--                                </li>--}}
{{--                                <li class="nav-item mb-2 me-2">--}}
{{--                                    <button class="nav-link px-3" type="button">SUV<i class="fi-x fs-xxs ms-2"></i></button>--}}
{{--                                </li>--}}
{{--                                <li class="nav-item mb-2 me-2">--}}
{{--                                    <button class="nav-link px-3" type="button">Diesel<i class="fi-x fs-xxs ms-2"></i></button>--}}
{{--                                </li>--}}
{{--                                <li class="nav-item mb-2 me-2">--}}
{{--                                    <button class="nav-link px-3" type="button">Gasoline<i class="fi-x fs-xxs ms-2"></i></button>--}}
{{--                                </li>--}}
{{--                                <li class="nav-item mb-2 me-2">--}}
{{--                                    <button class="nav-link px-3" type="button">Hybrid<i class="fi-x fs-xxs ms-2"></i></button>--}}
{{--                                </li>--}}
{{--                            </ul>--}}
{{--                        </div>--}}
                        <form action="{{ route('cars.index') }}" method="get">

                        <div class="pb-4 mb-2">
                            <h3 class="h6 text-light">Location</h3>
                            <select class="form-select form-select-light mb-2" name="location">
                                <option value="" disabled selected>Select location</option>
                                @foreach(\App\Models\Location::all() as $location)
                                    <option value="{{ $location->id }}" @if(request()->get('location') == $location->id ) selected  @endif>{{ $location->location }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="pb-4 mb-2">
                            <h3 class="h6 text-light">Car Type</h3>
                            <div class="overflow-auto" data-simplebar data-simplebar-auto-hide="false" data-simplebar-inverse style="height: 11rem;">
                                @foreach(\App\Models\CarType::all() as $carType)
                                    <div class="form-check form-check-light">
                                        <input class="form-check-input" name="carType[]" @if(in_array($carType->id, request()->get('carType') ? request()->get('carType') : [])) checked @endif value="{{ $carType->id }}"  type="checkbox" id="{{ $carType->type }}" >
                                        <label class="form-check-label fs-sm" for="{{ $carType->type }}">{{ $carType->type }}</label>
                                    </div>
                                @endforeach


                            </div>
                        </div>
                        <div class="pb-4 mb-2">
                            <h3 class="h6 text-light pt-1">Year</h3>
                            <div class="d-flex align-items-center">
                                <select class="form-select form-select-light w-100" name="yearFrom">
                                    <option value="0" disabled selected>From</option>
                                    @for($i = 2004; $i < 2023; $i++)
                                    <option value="{{ $i }}" @if(request()->get('yearFrom') == $i ) selected  @endif >{{ $i }}</option>
                                    @endfor

                                </select>
                                <div class="mx-2">&mdash;</div>
                                <select class="form-select form-select-light w-100" name="yearTo">
                                    <option value="" disabled selected>To</option>
                                    @for($i = 2004; $i < 2023; $i++)
                                        <option value="{{ $i }}" @if(request()->get('yearTo') == $i ) selected  @endif>{{ $i }}</option>
                                    @endfor

                                </select>
                            </div>
                        </div>
                        <div class="pb-4 mb-2">
                            <h3 class="h6 text-light">Mark &amp; Model</h3>
                            <select class="form-select form-select-light mb-2" name="mark"  id="mark">
                                <option value="0" selected>Any mark</option>
                                @foreach(\App\Models\CarMark::all() as $mark)
                                    <option value="{{ $mark->id }}" @if(request()->get('mark') == $mark->id ) selected  @endif >{{ $mark->mark }}</option>
                                @endforeach

                            </select>
                            <select class="form-select form-select-light mb-1" name="model" disabled id="model">
                                <option value="" disabled selected>Any model</option>
                            </select>
                        </div>
                        <div class="pb-4 mb-2">
                            <h3 class="h6 text-light">Price</h3>
                            <div class="range-slider range-slider-light mb-3" data-start-min="25000" data-start-max="65000" data-min="4000" data-max="100000" data-step="1000">
                                <div class="d-flex align-items-center">
                                    <div class="w-50 pe-2">
                                        <input class="form-control form-control-light range-slider-value-min" value="{{ request()->get('priceFrom')  }}" name="priceFrom" type="text" placeholder="From">
                                    </div>
                                    <div class="text-muted">&mdash;</div>
                                    <div class="w-50 ps-2">
                                        <input class="form-control form-control-light range-slider-value-max" value="{{ request()->get('priceTo')  }}" name="priceTo" type="text" placeholder="To">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="pb-4 mb-2">
                            <h3 class="h6 text-light">Drivetrain</h3>
                            @foreach(\App\Models\Drivetrain::all() as $drivetrain)
                                <div class="form-check form-check-light">
                                    <input class="form-check-input" @if(in_array($drivetrain->id, request()->get('drivetrain') ? request()->get('drivetrain') : [])) checked @endif name="drivetrain[]" value="{{ $drivetrain->id }}" type="checkbox" id="{{ $drivetrain->id }}">
                                    <label class="form-check-label fs-sm" for="awd">{{ $drivetrain->drivetrain }}</label>
                                </div>

                            @endforeach

                        </div>
                        <div class="pb-4 mb-2">
                            <h3 class="h6 text-light">Fuel Type</h3>
                            @foreach(\App\Models\Gas::all() as $gas)
                                <div class="form-check form-check-light">
                                    <input class="form-check-input" @if(in_array($gas->id, request()->get('gas') ? request()->get('gas') : [])) checked @endif name="gas[]" type="checkbox" value="{{ $gas->id }}" id="{{ $gas->gas }}">
                                    <label class="form-check-label fs-sm" for="{{ $gas->gas }}">{{ $gas->gas }}</label>
                                </div>
                            @endforeach

                        </div>
                        <div class="pb-4 mb-1">
                            <h3 class="h6 text-light">Transmission</h3>
                            <div class="form-check form-check-light">

                                <input class="form-check-input" @if(in_array('Automatic', request()->get('transmission') ? request()->get('transmission') : [])) checked @endif name="transmission[]" value="Automatic" type="checkbox" id="auto">
                                <label class="form-check-label fs-sm" for="auto">Automatic</label>
                            </div>
                            <div class="form-check form-check-light">
                                <input class="form-check-input" @if(in_array('Manual', request()->get('transmission') ? request()->get('transmission') : [])) checked @endif name="transmission[]" value="Manual" type="checkbox" id="manual">
                                <label class="form-check-label fs-sm" for="manual">Manual</label>
                            </div>
                        </div>
                        <div class="pb-4 mb-2">
                            <h3 class="h6 text-light pt-1">Mileage</h3>
                            <div class="d-flex align-items-center">
                                <input class="form-control form-control-light w-100" name="mileageFrom" type="number" min="0"  placeholder="From">
                                <div class="mx-2">&mdash;</div>
                                <input class="form-control form-control-light w-100" name="mileageTo" type="number" min="0"  placeholder="To">
                            </div>
                        </div>
                            <input type="submit" value="Filter Cars" class="btn btn-primary">

                    </div>
                </div>
            </div>
            <!-- Catalog grid view-->
            <div class="col-lg-9">
                <!-- Breadcrumb-->
                <nav class="mb-3 pt-md-2 pt-lg-4" aria-label="Breadcrumb">
                    <ol class="breadcrumb breadcrumb-light">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Cars</li>
                    </ol>
                </nav>
                <!-- Page title-->
                <div class="d-flex align-items-center justify-content-between pb-4 mb-2">
                    <h1 class="text-light me-3 mb-0">Used cars</h1>
                    <div class="text-light"><i class="fi-car fs-lg me-2"></i><span class="align-middle">{{ $totalOffers }} offers</span></div>
                </div>

                @php
                    $sort = [
                        ["Newest", "newest"],
                        ["Price: Low - High", 'lth'],
                        ["Price: High - Low", 'htl'],
                    ]
                @endphp


                <!-- Sorting + View-->
                <div class="d-sm-flex align-items-center justify-content-between pb-4 mb-2">
                    <div class="d-flex align-items-center me-sm-4">
                        <label class="fs-sm text-light me-2 pe-1 text-nowrap" for="sorting1"><i class="fi-arrows-sort mt-n1 me-2"></i>Sort by:</label>
                        <select class="form-select form-select-light form-select-sm me-sm-4" name="sort" id="sorting1">
                            @for($i = 0; $i < count($sort); $i++)
                                <option value="{{ $sort[$i][1] }}" @if(request()->get('sort') == $sort[$i][1]) selected @endif>{{ $sort[$i][0] }}</option>
                            @endfor
{{--                            <option value="lth">Price: Low - High</option>--}}
{{--                            <option value="htl">Price: Hight - Low</option>--}}
                        </select>
                        </form>
                        <div class="d-none d-md-block border-end border-light" style="height: 1.25rem;"></div>
                    </div>
                </div>
                <div class="row">
                    <div id="message">

                    </div>

                    @if(session()->has('success'))
                        <div class="alert alert-success">
                            {{ session()->get('success') }}
                        </div>
                    @endif
                    @if(session()->has('error'))
                        <div class="alert alert-danger">
                            {{ session()->get('error') }}
                        </div>
                    @endif

                    <!-- Item-->

                    @forelse($cars as $car)

                        <x-car :id="$car->id" :userId="$car->user->id" :used="$car->new" :year="$car->year" :name="$car->car_mark->mark" :price="$car->price" :location="$car->user->location->location" :mileage="$car->mileage" :transmission="$car->transmission" :gas="$car->gas->gas" :image="$car->car_images" :description="$car->description" :title="$car->title"/>
                    @empty
                        <div class="alert alert-danger">
                            <h6 class="text-danger lead">Sorry, currently we have no cars for this criteria</h6>
                        </div>
                    @endforelse

                </div>

                {{ $cars->withQueryString()->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>

@endsection

<input type="hidden" id="modelToSelect" value="0">

@section('scripts')
{{--    <script src="{{asset('assets/js/main.js')}}"></script>--}}
    <script>
        const deleteBtns = document.querySelectorAll('.btnDelete');
        const model = document.getElementById('model');
        const mark = document.querySelector('#mark');
        const modelToPreselect = 0;

        if(mark.value == 0){
            mark.addEventListener('change', function (e) {
                fetchModelOnValue(e.target.value);

            })
        }
        else {
            fetchModelOnValue(mark.value);
            mark.addEventListener('change', function (e) {
                fetchModelOnValue(e.target.value);

            })
        }


        deleteBtns.forEach((btn) => {
            btn.addEventListener('click', (e) => {
                e.preventDefault();
                if(confirm("Are you sure you want to delete?")) {
                    deleteCar(e.target.getAttribute('data-id')).then(response => response.json()).then(data => {
                        document.getElementById('message').innerHTML = `
                <div class="alert alert-success">
                        <ul>
                            <li>${data.Message}</li>
                        </ul>
                </div>
                `
                        window.scrollTo(0, 0);
                        document.getElementById('car-' + e.target.getAttribute('data-id')).remove();
                        setTimeout(() => {
                            document.getElementById('message').innerHTML = '';
                        }, 2500)
                        // window.scrollTo(0, 0);
                        // setTimeout(() => {
                        //     location.reload();
                        // }, 1500);
                    }).catch(error => {
                        document.getElementById('message').innerHTML = `
                <div class="alert alert-danger">
                        <ul>
                            <li>${error.ErrorMessage}</li>
                        </ul>
                </div>
                `
                    });

                }

            })
        })

        function deleteCar(id){
            return fetch('/cars/' + id, {
                headers: {
                    "Accept": "application/json",
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                method: "delete"
            });
        }

        async function fetchModel(markId){
            const data = await fetch('/models/' + markId);

            return await data.json();
        }

        function fetchModelOnValue(value){
            fetchModel(value).then(data => {
                model.removeAttribute('disabled');
                let html = '<option value="0">Any model</option>'
                data.forEach((option) => {
                    html += `
            <option value="${option.id}" ${option.id == modelToPreselect ? "selected" : ""} >${option.model}</option>
            `
                })
                model.innerHTML = html;
            });
        }
    </script>
@endsection


