@extends('layouts.admin.layout')

@section('content-admin')
    <!-- row -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4 col-sm-6">
                <div class="card">
                    <div class="stat-widget-two card-body">
                        <div class="stat-content">
                            <div class="stat-text">Total users of application</div>
                            <div class="stat-digit">{{ \App\Models\User::count() }}</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6 ">
                <div class="card ">
                    <div class="stat-widget-two card-body">
                        <div class="stat-content">
                            <div class="stat-text">Total cars</div>
                            <div class="stat-digit">{{ \App\Models\Car::count() }}</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6">
                <div class="card">
                    <div class="stat-widget-two card-body">
                        <div class="stat-content">
                            <div class="stat-text">Total worth of all cars</div>
                            <div class="stat-digit"> <i class="fa fa-usd"></i>
                                {{ \App\Models\Car::sum('price') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



    </div>
@endsection
