@extends('layouts.admin.layout')

@php
    $id = 1;
@endphp

@section('content-admin')
    <div class="container-fluid">
        <a href="{{ url()->previous() }}" class="btn btn-primary mb-5">Back to previous page</a>
        <div class="row">
            <div class="col-lg-12">
                <h1>Users</h1>

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
                <form action="{{ route('adminUser.index') }}">
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
                <form action="{{ route('adminUser.create') }}">
                    <div class="form-group">
                        <input type="submit" value="Add new user" class="btn btn-primary">
                    </div>
                </form>
                <table class="table">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Photo</th>
                        <th scope="col">First Name</th>
                        <th scope="col">Last Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Role</th>
                        <th scope="col">Location</th>
                        <th scope="col">Phone</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                    </thead>
                    <tbody class="text-dark">
                    @foreach($users as $user)
                        <tr>
                            <th scope="row">{{ $id++ }}</th>

                            <td><img width="50"  src="{{ $user->photo == null ? asset('assets/img/default.jpg') : asset('storage/img/' . $user->id . '/profile/' . $user->photo) }}" alt=""></td>
                            <td>{{ $user->first_name }}</td>
                            <td>{{ $user->last_name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->role->role }}</td>
                            <td>{{ $user->location->location }}</td>
                            <td>{{ $user->phone }}</td>
                            <form action="{{ route('adminUser.edit', ['adminUser' => $user->id]) }}" method="get">
                                <td><button class="btn btn-primary">Edit</button></td>
                            </form>
                            <td><a href="#" class="btn btn-danger delete" data-delete="{{ $user->id }}">Delete</a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{ $users->withQueryString()->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/js/userAdmin.js') }}"></script>
@endsection
