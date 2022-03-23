@extends('layouts.front.layout')

@section('content')
    <div class="container mt-5 mb-md-4 py-5">
        <div class="row">
            <!-- Page content-->
            <div class="col-lg-8">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
            @endif
            <!-- Title-->
                <form action="{{ route('cars.update', ['car' => $car->id]) }}" method="post"
                      enctype="multipart/form-data">
                    @method("PUT")
                    @csrf
                    <div class="mb-4">
                        <h1 class="h2 text-light mb-0">Edit car</h1>
                    </div>
                    <!-- Basic info-->
                    <section class="card card-light card-body border-0 shadow-sm p-4 mb-4" id="basic-info">
                        <h2 class="h4 text-light mb-4"><i class="fi-info-circle text-primary fs-5 mt-n1 me-2"></i>Basic
                            info</h2>
                        <div class="mb-3">
                            <label class="form-label text-light" for="sc-title">Title <span class="text-danger">*</span></label>
                            <input class="form-control form-control-light" name="title" value="{{ $car->title }}"
                                   type="text" id="sc-title" placeholder="">
                        </div>
                        <div class="row">
                            <div class="col-sm-6 mb-3">
                                <label class="form-label text-light" for="sc-condition">Vehicle condition <span
                                        class="text-danger">*</span></label>
                                <select class="form-select form-select-light" name="condition" id="sc-condition">
                                    <option value="" disabled hidden>Choose condition</option>
                                    <option value="Used" @if($car->new == 'Used') selected @endif>Used</option>
                                    <option value="New" @if($car->new == 'New') selected @endif>New</option>
                                </select>
                            </div>
                        </div>

                    </section>
                    <!-- Price-->
                    <section class="card card-light card-body border-0 shadow-sm p-4 mb-4" id="price">
                        <h2 class="h4 text-light mb-4"><i class="fi-cash text-primary fs-5 mt-n1 me-2"></i>Price</h2>
                        <label class="form-label text-light" for="sc-price">Price ($)<span class="text-danger">*</span></label>
                        <div class="d-sm-flex mb-2">
                            <input class="form-control form-control-light w-100 me-2 mb-2" value="{{ $car->price }}"
                                   name="price" type="number" id="sc-price">
                        </div>
                    </section>
                    <!-- Vehicle information-->
                    <section class="card card-light card-body border-0 shadow-sm p-4 mb-4" id="vehicle-info">
                        <h2 class="h4 text-light mb-4"><i class="fi-car text-primary fs-5 mt-n1 me-2"></i>Vehicle
                            information</h2>
                        <div class="row pb-2">
                            <div class="col-sm-6 mb-3">
                                <label class="form-label text-light" for="sc-make">Mark <span
                                        class="text-danger">*</span></label>
                                <select class="form-select form-select-light" name="car_mark" id="mark">
                                    <option value="0">Select make</option>
                                    @foreach(\App\Models\CarMark::all() as $mark)
                                        <option value="{{ $mark->id }} "
                                                @if($car->car_mark_id == $mark->id) selected @endif>{{ $mark->mark }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-6 mb-3">
                                <label class="form-label text-light" for="sc-model">Model <span
                                        class="text-danger">*</span></label>
                                <select class="form-select form-select-light" name="model" id="model">
                                    <option value="" disabled>Select model</option>
                                    {{-- Models in main.js --}}
                                </select>
                            </div>
                            <div class="col-md-3 col-sm-6 mb-3">
                                <label class="form-label text-light" for="sc-year">Year <span
                                        class="text-danger">*</span></label>
                                <select class="form-select form-select-light" name="year" id="sc-year">
                                    <option value="" disabled>Select year</option>
                                    @for($i = 2004; $i < 2023; $i++)
                                        <option value="{{ $i }}" @if($car->year == $i) selected @endif>{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="col-md-3 col-sm-6 mb-3">
                                <label class="form-label text-light" for="sc-mileage">Mileage <span class="text-danger">*</span></label>
                                <input class="form-control form-control-light" value="{{ $car->mileage }}" type="number"
                                       name="mileage" id="sc-mileage" placeholder="Enter mileage">
                            </div>
                        </div>
                        <div class="border-top border-light mt-2 pt-4">
                            <div class="row pb-2">
                                <div class="col-md-6">
                                    <label class="form-label text-light" for="sc-body">Body type <span
                                            class="text-danger">*</span></label>
                                    <select class="form-select form-select-light mb-3" name="car_type" id="sc-body">
                                        <option value="0" disabled>Select car type</option>
                                        @foreach(\App\Models\CarType::all() as $type)
                                            <option value="{{ $type->id }}"
                                                    @if($car->car_type_id == $type->id) selected @endif>{{ $type->type }}</option>
                                        @endforeach
                                    </select>
                                    <label class="form-label text-light" for="sc-fuel">Fuel type <span
                                            class="text-danger">*</span></label>
                                    <select class="form-select form-select-light mb-3" name="gas" id="sc-fuel">
                                        <option value="" disabled>Select fuel type</option>
                                        @foreach(\App\Models\Gas::all() as $gas)
                                            <option value="{{ $gas->id }}"
                                                    @if($car->gas_id == $gas->id) selected @endif>{{ $gas->gas }}</option>
                                        @endforeach
                                    </select>
                                    <label class="form-label text-light" for="sc-transmission">Transmission <span
                                            class="text-danger">*</span></label>
                                    <select class="form-select form-select-light mb-3" name="transmission"
                                            id="sc-transmission">
                                        <option value="" disabled>Select transmission</option>
                                        <option value="Manual" @if($car->transmission == "Manual") selected @endif>
                                            Manual
                                        </option>
                                        <option value="Automatic"
                                                @if($car->transmission == "Automatic") selected @endif>Automatic
                                        </option>
                                    </select>
                                    <label class="form-label text-light" for="sc-drivetrain">Drivetrain <span
                                            class="text-danger">*</span></label>
                                    <select class="form-select form-select-light mb-3" name="drivetrain"
                                            id="sc-drivetrain">
                                        <option value="" disabled>Select drivetrain</option>
                                        @foreach(\App\Models\Drivetrain::all() as $drivetrain)
                                            <option value="{{ $drivetrain->id }}"
                                                    @if($car->drivetrain_id == $drivetrain->id) selected @endif >{{ $drivetrain->drivetrain }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="border-top border-light mt-2 pt-4">
                            <label class="form-label text-light" for="sc-description">Description </label>
                            <textarea class="form-control form-control-light" name="description" id="sc-description"
                                      rows="5" placeholder="Describe your vehicle">{{ $car->description }}</textarea>
                        </div>
                    </section>

                    <section class="card card-light card-body shadow-sm p-4 mb-4" id="photos">
                        <h2 class="h4 text-light mb-4"><i class="fi-image text-primary fs-5 mt-n1 me-2"></i>Current
                            Photos</h2>

                        <div class="row">
                            <div class="alert alert-warning bg-faded-warning border-warning mb-4" role="alert">
                                <div class="d-flex"><i class="fi-alert-circle me-2 me-sm-3"></i>
                                    <p class="fs-sm mb-1">The maximum photo size is 8 MB. Formats: jpeg, jpg, png. Put
                                        the main picture first.<br>The maximum video size is 10 MB. Formats: mp4, mov.
                                    </p>
                                </div>
                            </div>
                            @foreach($car->car_images as $img)

                                <div>
                                    <img src="{{ asset("storage/img/" . session()->get('user')->id . "/$img->image") }}"
                                         alt="" width="75" class="img-fluid m-3 d-inline">
                                    <button class="btn btn-primary delete-img" data-id="{{ $img->id }}" type="button">
                                        Delete
                                    </button>
                                    <div id="msg">

                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <input class="file-uploader file-uploader-grid bg-faded-light border-light" name="files[]"
                               type="file" multiple data-max-file-size="10MB"
                               accept="image/png, image/jpeg, video/mp4, video/mov"
                               data-label-idle="&lt;div class=&quot;btn btn-primary mb-3&quot;&gt;&lt;i class=&quot;fi-cloud-upload me-1&quot;&gt;&lt;/i&gt;Upload photos / video&lt;/div&gt;&lt;div class=&quot;text-light opacity-70&quot;&gt;or drag them in&lt;/div&gt;">
                    </section>
                    <div class="d-sm-flex justify-content-between pt-2">
                        <button type="submit" class="btn btn-primary btn-lg d-block mb-2"
                                href="car-finder-promotion.html">Update your car
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

<input type="hidden" id="modelToPreselect" value="{{ $car->car_model->id }}">

@section('scripts')
    <script src="{{asset('assets/js/deleteImage.js')}}"></script>
    <script src="{{asset('assets/js/main.js')}}"></script>
@endsection




