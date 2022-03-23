@extends('layouts.admin.layout')

@section('content-admin')
    <div class="container-fluid">
        <a href="{{ url()->previous() }}" class="btn btn-primary">Back to previous page</a>
    </div>

    <div class="container">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('location.update', ['location' => $location->id]) }}" method="post">
            @method('put')
            @csrf
            <div class="row">
                <div class="form-group col-12">
                    <label for="location" class="text-dark">Location</label>
                    <input type="text" value="{{ $location->location }}" name="location" id="location" class="form-control" placeholder="location...">
                </div>
                <div class="form-group col-3">
                    <button type="submit" class="btn btn-primary">Edit Location</button>
                </div>
            </div>
        </form>
    </div>

@endsection


