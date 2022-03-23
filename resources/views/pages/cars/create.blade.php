@extends('layouts.front.layout')

@section('content')
    <div class="container mt-5 mb-md-4 py-5">
        <div class="row">
            <!-- Page content-->
            <div class="col-lg-8">
                <!-- Breadcrumb-->
                <nav class="mb-3 pt-md-3" aria-label="Breadcrumb">
                    <ol class="breadcrumb breadcrumb-light">
                        <li class="breadcrumb-item"><a href="car-finder-home.html">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Sell car</li>
                    </ol>
                </nav>
                <!-- Title-->
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if(session()->has('error'))
                    <div class="alert alert-danger">
                        <p>{{ session()->get('error') }}</p>
                    </div>
                @endif
                <form action="{{ route('cars.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4">
                        <h1 class="h2 text-light mb-0">Sell car</h1>
                    </div>
                    <!-- Basic info-->
                    <section class="card card-light card-body border-0 shadow-sm p-4 mb-4" id="basic-info">
                        <h2 class="h4 text-light mb-4"><i class="fi-info-circle text-primary fs-5 mt-n1 me-2"></i>Basic info</h2>
                        <div class="mb-3">
                            <label class="form-label text-light" for="sc-title">Title <span class="text-danger">*</span></label>
                            <input class="form-control form-control-light" name="title" type="text" id="sc-title" placeholder="" >
                        </div>
                        <div class="row">
                            <div class="col-sm-6 mb-3">
                                <label class="form-label text-light" for="sc-condition">Vehicle condition <span class="text-danger">*</span></label>
                                <select class="form-select form-select-light" name="condition" id="sc-condition" >
                                    <option value="" disabled hidden>Choose condition</option>
                                    <option value="Used">Used</option>
                                    <option value="New">New</option>
                                </select>
                            </div>
                        </div>

                    </section>
                    <!-- Price-->
                    <section class="card card-light card-body border-0 shadow-sm p-4 mb-4" id="price">
                        <h2 class="h4 text-light mb-4"><i class="fi-cash text-primary fs-5 mt-n1 me-2"></i>Price</h2>
                        <label class="form-label text-light" for="sc-price">Price ($)<span class="text-danger">*</span></label>
                        <div class="d-sm-flex mb-2">
                            <input class="form-control form-control-light w-100 me-2 mb-2" name="price" type="number" id="sc-price" min="200"    >
                        </div>
                    </section>
                    <!-- Vehicle information-->
                    <section class="card card-light card-body border-0 shadow-sm p-4 mb-4" id="vehicle-info">
                        <h2 class="h4 text-light mb-4"><i class="fi-car text-primary fs-5 mt-n1 me-2"></i>Vehicle information</h2>
                        <div class="row pb-2">
                            <div class="col-sm-6 mb-3">
                                <label class="form-label text-light" for="sc-make">Mark <span class="text-danger">*</span></label>
                                <select class="form-select form-select-light" name="car_mark" id="mark">
                                    <option value="0">Select make</option>
                                    @foreach(\App\Models\CarMark::all() as $mark)
                                        <option value="{{ $mark->id }}">{{ $mark->mark }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-6 mb-3">
                                <label class="form-label text-light" for="sc-model">Model <span class="text-danger">*</span></label>
                                <select class="form-select form-select-light" name="model" id="model">
                                    <option value="" disabled >Select model</option>
                                    {{-- Models in main.js --}}
                                </select>
                            </div>
                            <div class="col-md-3 col-sm-6 mb-3">
                                <label class="form-label text-light" for="sc-year">Year <span class="text-danger">*</span></label>
                                <select class="form-select form-select-light" name="year" id="sc-year">
                                    <option value="" disabled>Select year</option>
                                    @for($i = 2004; $i < 2023; $i++)
                                        <option value="{{ $i }}" @if(request()->get('yearTo') == $i ) selected  @endif>{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="col-md-3 col-sm-6 mb-3">
                                <label class="form-label text-light" for="sc-mileage">Mileage <span class="text-danger">*</span></label>
                                <input class="form-control form-control-light" type="number" name="mileage" id="sc-mileage"  placeholder="Enter mileage">
                            </div>
                        </div>
                        <div class="border-top border-light mt-2 pt-4">
                            <div class="row pb-2">
                                <div class="col-md-6">
                                    <label class="form-label text-light" for="sc-body">Body type <span class="text-danger">*</span></label>
                                    <select class="form-select form-select-light mb-3" name="car_type" id="sc-body">
                                        <option value="0" disabled>Select car type</option>
                                        @foreach(\App\Models\CarType::all() as $type)
                                            <option value="{{ $type->id }}">{{ $type->type }}</option>
                                        @endforeach
                                    </select>
                                    <label class="form-label text-light" for="sc-fuel">Fuel type <span class="text-danger">*</span></label>
                                    <select class="form-select form-select-light mb-3" name="gas" id="sc-fuel">
                                        <option value="" disabled>Select fuel type</option>
                                        @foreach(\App\Models\Gas::all() as $gas)
                                            <option value="{{ $gas->id }}">{{ $gas->gas }}</option>
                                        @endforeach
                                    </select>
                                    <label class="form-label text-light" for="sc-engine">Engine <span class="text-danger">*</span></label>
                                    <label class="form-label text-light" for="sc-transmission">Transmission <span class="text-danger">*</span></label>
                                    <select class="form-select form-select-light mb-3" name="transmission" id="sc-transmission">
                                        <option value="" disabled>Select transmission</option>
                                        <option value="Manual">Manual</option>
                                        <option value="Automatic" selected>Automatic</option>
                                    </select>
                                    <label class="form-label text-light" for="sc-drivetrain">Drivetrain <span class="text-danger">*</span></label>
                                    <select class="form-select form-select-light mb-3" name="drivetrain" id="sc-drivetrain">
                                        <option value="" disabled>Select drivetrain</option>
                                        @foreach(\App\Models\Drivetrain::all() as $drivetrain)
                                            <option value="{{ $drivetrain->id }}" >{{ $drivetrain->drivetrain }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="border-top border-light mt-2 pt-4">
                            <label class="form-label text-light" for="sc-description">Description </label>
                            <textarea class="form-control form-control-light" name="description" id="sc-description" rows="5" placeholder="Describe your vehicle"></textarea><span class="form-text text-light opacity-50">3000 characters left</span>
                        </div>
                    </section>
                    <!-- Photos / video-->
                    <section class="card card-light card-body shadow-sm p-4 mb-4" id="photos">
                        <h2 class="h4 text-light mb-4"><i class="fi-image text-primary fs-5 mt-n1 me-2"></i>Photos / video</h2>
                        <div class="alert alert-warning bg-faded-warning border-warning mb-4" role="alert">
                            <div class="d-flex"><i class="fi-alert-circle me-2 me-sm-3"></i>
                                <p class="fs-sm mb-1">The maximum photo size is 8 MB. Formats: jpeg, jpg, png. Put the main picture first.<br></p>
                            </div>
                        </div>
                        <input class="file-uploader file-uploader-grid bg-faded-light border-light" name="files[]" type="file" multiple data-max-file-size="10MB" accept="image/png, image/jpeg, video/mp4, video/mov" data-label-idle="&lt;div class=&quot;btn btn-primary mb-3&quot;&gt;&lt;i class=&quot;fi-cloud-upload me-1&quot;&gt;&lt;/i&gt;Upload photos / video&lt;/div&gt;&lt;div class=&quot;text-light opacity-70&quot;&gt;or drag them in&lt;/div&gt;">
                    </section>

                    <div class="d-sm-flex justify-content-between pt-2"><button type="submit" class="btn btn-primary btn-lg d-block mb-2" href="car-finder-promotion.html">Save and continue</button></div>
                </form>

            </div>

        </div>
    </div>

@endsection

<input type="hidden" value="0" id="modelToPreselect">

@section('scripts')
    <script src="{{asset('assets/js/main.js')}}">

    </script>
@endsection



