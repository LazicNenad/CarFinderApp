@extends('layouts.admin.layout')

@php
    $id = 1;
@endphp

@section('content-admin')
    <div class="container-fluid">
        <a href="{{ url()->previous() }}" class="btn btn-primary mb-5">Back to previous page</a>
        <div class="row">
            <div class="col-lg-12">
                <h1>Locations</h1>

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
                <form action="{{ route('location.index') }}">
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
                <form action="{{ route('location.create') }}">
                    <div class="form-group">
                        <input type="submit" value="Add new location" class="btn btn-primary">
                    </div>
                </form>
                <table class="table">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Location</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                    </thead>
                    <tbody class="text-dark">
                    @foreach($locations as $location)
                        <tr>
                            <th scope="row">{{ $id++ }}</th>
                            <td>{{ $location->location }}</td>
                            <form action="{{ route('location.edit', ['location' => $location->id]) }}" method="get">
                                <td>
                                    <button class="btn btn-primary">Edit</button>
                                </td>
                            </form>
                            <td><a href="#" class="btn btn-danger delete" data-delete="{{ $location->id }}">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        const deleteBtns = document.querySelectorAll('.delete');

        deleteBtns.forEach((btn) => {
            btn.addEventListener('click', (e) => {
                e.preventDefault();
                let idToDelete = e.target.getAttribute('data-delete');

                deleteUser(idToDelete).then(res => res.json()).then(data => location.reload()).catch(error => {
                    document.getElementById('message').innerHTML = `
            <div class="alert alert-danger">
                      ${error.message}
            </div>
            `
                });
            })
        })


        function deleteUser(id) {
            return fetch('/admin/location/' + id, {
                method: "delete",
                headers: {
                    "Accept": "application/json",
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            })
        }

    </script>
@endsection



