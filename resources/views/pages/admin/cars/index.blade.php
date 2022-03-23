@extends('layouts.admin.layout')

@php
    $id = 1;
@endphp

@section('content-admin')
    <div class="container-fluid">
            <a href="{{ url()->previous() }}" class="btn btn-primary mb-5">Back to previous page</a>
        <div class="row">
            <div class="col-lg-12">
                <h1>Cars</h1>

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
                <div id="message">

                </div>
                <form action="{{ route('adminCar.index') }}">
                    <div class="form-group row">
                        <div class="col-lg-4">
                            <input type="text" value="{{ request()->get('keywords') }}" name="keywords"
                                   class="form-control" placeholder="keywords...">
                        </div>
                        <div class="col-lg-4">
                            <input type="submit" class="btn btn-primary">
                        </div>
                    </div>
                </form>
                <form action="{{ route('adminCar.create') }}">
                    <div class="form-group">
                        <input type="submit" value="Add new car" class="btn btn-primary">
                    </div>
                </form>
                <table class="table">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Image</th>
                        <th scope="col">Title</th>
                        <th scope="col">Mark</th>
                        <th scope="col">Model</th>
                        <th scope="col">User</th>
                        <th scope="col">Description</th>
                        <th scope="col">Year</th>
                        <th scope="col">Price</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                    </thead>
                    <tbody class="text-dark">
                    @foreach($cars as $car)
                        <tr>
                            <th scope="row">{{ $id++ }}</th>
                            <td><a target="_blank" href="{{ route('cars.show', ['car' => $car->id]) }}"><img src="{{ asset('assets/img/resized/' . $car->user_id . '_resized_' . $car->car_images[0]->image) }}" width="70" alt=""></a></td>
                            <td>{{ $car->title }}</td>
                            <td>{{ $car->car_mark->mark }}</td>
                            <td>{{ $car->car_model->model }}</td>
                            <td>{{ $car->user->first_name . ' ' . $car->user->last_name . ' (id - '. $car->user->id . ')' }}</td>
                            <td>{{ $car->description }}</td>
                            <td>{{ $car->year }}</td>
                            <td>{{ $car->price }}</td>
                            <form action="{{ route('adminCar.edit', ['adminCar' => $car->id]) }}">
                                <td><button  class="btn btn-secondary edit-btns">Edit</button>
                                </td>
                            </form>
                            <td><a href="#" class="btn btn-danger btnDelete" id="car-{{$car->id}}" data-id="{{ $car->id }}">Delete</a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{ $cars->withQueryString()->links('pagination::bootstrap-4')  }}
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/js/carsAdmin.js') }}"></script>
@endsection
