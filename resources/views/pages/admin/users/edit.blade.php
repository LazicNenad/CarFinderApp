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
        <form action="{{ route('adminUser.update', ['adminUser' => $user->id]) }}" enctype="multipart/form-data" method="post">
            @method('put')
            @csrf
            <div class="row">
                <div class="form-group col-6">
                    <label for="first_name" class="text-dark">First Name</label>
                    <input type="text" value="{{ $user->first_name }}" name="first_name" id="first_name" class="form-control" placeholder="First name...">
                </div>

                <div class="form-group col-6">
                    <label for="last_name" class="text-dark">Last Name</label>
                    <input type="text" value="{{ $user->last_name }}" name="last_name" id="last_name" class="form-control" placeholder="Last name...">
                </div>

                <div class="form-group col-6">
                    <label for="email" class="text-dark">Email</label>
                    <input type="email" value="{{ $user->email }}" name="email" id="email" class="form-control" placeholder="Email...">
                </div>

                <div class="form-group col-6">
                    <label for="role" class="text-dark">Role</label>
                    <select name="role" id="role" class="form-control">
                        <option value="0" disabled>Choose role</option>
                        @foreach(\App\Models\Role::all() as $role)
                            <option value="{{ $role->id }}" @if($user->role_id == $role->id) selected @endif>{{ $role->role }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group col-6">
                    <label for="location" class="text-dark">Location</label>
                    <select name="location" id="location" class="form-control">
                        <option value="0" disabled>Choose location</option>
                        @foreach(\App\Models\Location::all() as $location)
                            <option value="{{ $location->id }}" @if($user->location_id == $location->id) selected @endif>{{ $location->location }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group col-6">
                    <label for="phone" class="text-dark">Phone number</label>
                    <input type="text" value="{{ $user->phone }}" name="phone" id="phone" class="form-control">
                </div>

                <div class="form-group col-3">
                    <input type="submit" value="Edit user" class="btn btn-primary btn-block my-3">
                </div>
            </div>
        </form>
    </div>

@endsection
