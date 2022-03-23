@extends('layouts.admin.layout')

@section('content-admin')
    <div class="container-fluid">
        <a href="{{ url()->previous() }}" class="btn btn-primary">Back to previous page</a>
    </div>

    <div class="container">
        <h3 class="pb-4">Edit car: <b class="text-primary">{{ $car->title }}</b> user:  <b class="text-primary">{{ $car->user->first_name }} {{ $car->user->last_name }}</b></h3>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('adminCar.update', ['adminCar' => $car->id]) }}" enctype="multipart/form-data" method="post">
            @method('put')
            @csrf
            <div class="row">
                <div class="form-group col-6">
                    <label for="title" class="text-dark">Title</label>
                    <input type="text" name="title" value="{{ $car->title }}" id="title" class="form-control" placeholder="Title...">
                </div>

                <div class="form-group col-6">
                    <label for="mark" class="text-dark">Mark</label>
                    <select name="car_mark" id="mark" class="form-control">
                        <option value="0" disabled selected>Choose mark</option>
                        @foreach(\App\Models\CarMark::all() as $mark)
                            <option value="{{ $mark->id }}" @if($car->car_mark_id == $mark->id) selected @endif>{{ $mark->mark }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group col-6">
                    <label for="model" class="text-dark">Model</label>
                    <select name="model" id="model" class="form-control">
                        <option value="0" disabled selected>Choose Model</option>
                    </select>
                </div>

                <div class="form-group col-6">
                    <label for="type" class="text-dark">Car Type</label>
                    <select name="car_type" id="type" class="form-control">
                        @foreach(\App\Models\CarType::all() as $type)
                            <option value="{{ $type->id }}" @if($car->car_type_id == $type->id) selected @endif>{{ $type->type }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group col-6">
                    <label for="gas" class="text-dark">Gas</label>
                    <select name="gas" id="gas" class="form-control">
                        @foreach(\App\Models\Gas::all() as $gas)
                            <option value="{{ $gas->id }}" @if($car->gas_id == $gas->id) selected @endif>{{ $gas->gas }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group col-6">
                    <label for="drivetrain" class="text-dark">Drivetrain</label>
                    <select name="drivetrain" id="drivetrain" class="form-control">
                        @foreach(\App\Models\Drivetrain::all() as $drivetrain)
                            <option value="{{ $drivetrain->id }}" @if($car->drivetrain_id == $drivetrain->id) selected @endif>{{ $drivetrain->drivetrain }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group col-12">
                    <label for="description" class="text-dark">Description</label>
                    <textarea name="description" class="form-control p-2" id="description" cols="30" rows="10" style="width: 100%">{{ $car->description }}</textarea>
                </div>

                <div class="form-group col-6">
                    <label for="year" class="text-dark">Year</label>
                    <select name="year" id="year" class="form-control">
                        @for($i = 2004; $i < 2023; $i++)
                            <option value="{{ $i }}" @if($car->year == $i) selected @endif>{{ $i }}</option>
                        @endfor
                    </select>
                </div>

                <div class="form-group col-6">
                    <label for="condition" class="text-dark">Condition</label>
                    <select name="condition" id="condition" class="form-control">
                        <option value="new" @if($car->new == 'New') selected @endif>New</option>
                        <option value="used" @if($car->new == 'Used') selected @endif>Used</option>
                    </select>
                </div>

                <div class="form-group col-6">
                    <label for="transmission" class="text-dark">Transmission</label>
                    <select name="transmission" id="transmission" class="form-control">
                        <option value="automatic" @if($car->transmission == "Automatic") selected @endif>Automatic</option>
                        <option value="manual" @if($car->transmission == "Manual") selected @endif>Manual</option>
                    </select>
                </div>

                <div class="form-group col-6">
                    <label for="mileage" class="text-dark">Mileage</label>
                    <input type="number" value="{{ $car->mileage }}" name="mileage" id="mileage" class="form-control">
                </div>

                <div class="form-group col-6">
                    <label for="price" class="text-dark">Price</label>
                    <input type="number" name="price" value="{{ $car->price }}" id="price" class="form-control">
                </div>

                <div class="form-group col-12">
                    @foreach($car->car_images as $img)
                        <div>
                            <img src="{{ asset("storage/img/" . $car->user_id . "/$img->image") }}" alt="" width="75" class="img-fluid m-3 d-inline">
                            <button class="btn btn-primary delete-img" data-id="{{ $img->id }}" type="button">Delete</button>
                            <div id="msg">

                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="form-group col-12">
                    <label for="images" class="text-dark">Images</label>
                    <input type="file" name="files[]" id="images" multiple>
                </div>

                <div class="form-group col-3">
                    <input type="submit" value="Edit Car" class="btn btn-primary btn-block my-3">
                </div>


            </div>
        </form>
    </div>

    <input type="hidden" id="modelToPreselect" value="{{ $car->car_model->id }}">
@endsection

@section('scripts')
    <script src="{{asset('assets/js/deleteImage.js')}}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
@endsection
