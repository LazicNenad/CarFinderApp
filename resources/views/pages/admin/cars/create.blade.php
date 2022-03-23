@extends('layouts.admin.layout')

@section('content-admin')
    <div class="container-fluid">
        <a href="{{ url()->previous() }}" class="btn btn-primary">Back to previous page</a>
    </div>

    <div class="container">
        <form action="{{ route('adminCar.store') }}" enctype="multipart/form-data" method="post">
            @csrf
            <div class="row">
                <div class="form-group col-6">
                    <label for="title" class="text-dark">Title</label>
                    <input type="text" name="title" id="title" class="form-control" placeholder="Title...">
                </div>

                <div class="form-group col-6">
                    <label for="mark" class="text-dark">Mark</label>
                    <select name="car_mark" id="mark" class="form-control">
                        <option value="0" disabled selected>Choose mark</option>
                        @foreach(\App\Models\CarMark::all() as $mark)
                            <option value="{{ $mark->id }}">{{ $mark->mark }}</option>
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
                            <option value="{{ $type->id }}">{{ $type->type }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group col-6">
                    <label for="gas" class="text-dark">Gas</label>
                    <select name="gas" id="gas" class="form-control">
                        @foreach(\App\Models\Gas::all() as $gas)
                            <option value="{{ $gas->id }}">{{ $gas->gas }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group col-6">
                    <label for="drivetrain" class="text-dark">Drivetrain</label>
                    <select name="drivetrain" id="drivetrain" class="form-control">
                        @foreach(\App\Models\Drivetrain::all() as $drivetrain)
                            <option value="{{ $drivetrain->id }}">{{ $drivetrain->drivetrain }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group col-12">
                    <label for="description" class="text-dark">Description</label>
                    <textarea name="description" id="description" cols="30" rows="10" style="width: 100%"></textarea>
                </div>

                <div class="form-group col-6">
                    <label for="year" class="text-dark">Year</label>
                    <select name="year" id="year" class="form-control">
                        @for($i = 2004; $i < 2023; $i++)
                            <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                    </select>
                </div>

                <div class="form-group col-6">
                    <label for="condition" class="text-dark">Condition</label>
                    <select name="condition" id="condition" class="form-control">
                        <option value="new">New</option>
                        <option value="used">Used</option>
                    </select>
                </div>

                <div class="form-group col-6">
                    <label for="transmission" class="text-dark">Transmission</label>
                    <select name="transmission" id="transmission" class="form-control">
                        <option value="automatic">Automatic</option>
                        <option value="manual">Manual</option>
                    </select>
                </div>

                <div class="form-group col-6">
                    <label for="mileage" class="text-dark">Mileage</label>
                    <input type="number" name="mileage" id="mileage" class="form-control">
                </div>

                <div class="form-group col-6">
                    <label for="price" class="text-dark">Price</label>
                    <input type="number" name="price" id="price" class="form-control">
                </div>

                <div class="form-group col-12">
                    <label for="images" class="text-dark">Images</label>
                    <input type="file" name="files[]" id="images" multiple>
                </div>

                <div class="form-group col-3">
                    <input type="submit" value="Add car" class="btn btn-primary btn-block my-3">
                </div>
            </div>
        </form>
    </div>

@endsection



@section('scripts')
    <script>
        const model = document.getElementById('model');
        const mark = document.querySelector('#mark');
        // const modelToPreselect = document.getElementById('modelToPreselect').value;

        // if(mark.value == 0){
        //     mark.addEventListener('change', function (e) {
        //         fetchModelOnValue(e.target.value);
        //
        //     })
        // }
        // else {
        //     fetchModelOnValue(mark.value);
        // }

        mark.addEventListener('change', function (e) {
            fetchModelOnValue(e.target.value);
        })

        async function fetchModel(markId) {
            const data = await fetch('/models/' + markId);

            return await data.json();
        }

        function fetchModelOnValue(value) {
            fetchModel(value).then(data => {
                model.removeAttribute('disabled');
                let html = '<option value="0">Any model</option>'
                data.forEach((option) => {
                    html += `
            <option value="${option.id}" >${option.model}</option>
            `
                })
                model.innerHTML = html;
            });
        }

    </script>

@endsection
