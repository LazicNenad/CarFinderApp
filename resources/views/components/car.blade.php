<div class="col-sm-6 mb-4" id="car-{{$id}}">
    <div class="card card-light card-hover h-100">
        <div  class="tns-carousel-wrapper card-img-top card-img-hover"><a class="img-overlay" href="{{ route('cars.show', ['car' => $id]) }}"></a>
            <div class="position-absolute start-0 top-0 pt-3 ps-3"><span class="d-table badge bg-info">{{ $used }}</span></div>
            <div class="content-overlay end-0 top-0 pt-3 pe-3">
                <button class="btn btn-icon btn-light btn-xs text-primary rounded-circle" type="button" data-bs-toggle="tooltip" data-bs-placement="left" title="Add to Wishlist"><i class="fi-heart"></i></button>
            </div>
            <div ><img src="{{ asset('storage/img/'. $userId .'/' . $image[0]->image) }}" alt="{{ $title }}"></div>
        </div>
        <div class="card-body">
            <div class="d-flex align-items-center justify-content-between pb-1"><span class="fs-sm text-light me-3">{{ $year }}</span>

            </div>
            <h3 class="h6 mb-1"><a class="nav-link-light" href="{{ route('cars.show', ['car' => $id]) }}">{{ $title }}</a></h3>
            <h4 class="h6 mb-1"><a class="nav-link-light" href="{{ route('cars.show', ['car' => $id]) }}">{{ $name }}</a></h4>
            <div class="text-primary fw-bold mb-1">$ {{ $price }}</div>
            <div class="fs-sm text-light opacity-70"><i class="fi-map-pin me-1"></i>{{ $location }}</div>

            <h5 class="h6 mb-1"><a class="nav-link-light" href="{{ route('cars.show', ['car' => $id]) }}">{{ $description }}</a></h5>
        </div>
        <div class="card-footer border-0 pt-0">
            <div class="border-top border-light pt-3">
                <div class="row g-2">
                    <div class="col me-sm-1">
                        <div class="bg-dark rounded text-center w-100 h-100 p-2"><i class="fi-dashboard d-block h4 text-light mb-0 mx-center"></i><span class="fs-xs text-light">{{ $mileage }}km</span></div>
                    </div>
                    <div class="col me-sm-1">
                        <div class="bg-dark rounded text-center w-100 h-100 p-2"><i class="fi-gearbox d-block h4 text-light mb-0 mx-center"></i><span class="fs-xs text-light">{{ $transmission }}</span></div>
                    </div>
                    <div class="col">
                        <div class="bg-dark rounded text-center w-100 h-100 p-2"><i class="fi-petrol d-block h4 text-light mb-0 mx-center"></i><span class="fs-xs text-light">{{ $gas }}</span></div>
                    </div>
                </div>
            </div>
        </div>
{{--        @if(session()->get('user') && session()->get('user')->role->role === "Admin")--}}
{{--            <a class="btn btn-danger btn-sm ms-2 order-lg-3 my-2 btnDelete" data-id="{{ $id }}" href="#">--}}
{{--                Delete--}}
{{--            </a>--}}
{{--        @endif--}}

        @if(session()->get('user'))
{{--            @foreach(session()->get('user')->cars as $userCar)--}}
                @if(session()->get('user')->id == $userId)
                    <a class="btn btn-info btn-sm ms-2 order-lg-3 my-2" href="{{ route('cars.edit', ['car' => $id]) }}">
                        Edit
                    </a>
                @endif
                @if(session()->get('user')->id == $userId || session()->get('user') && session()->get('user')->role->role === "Admin")
                <a class="btn btn-danger btn-sm ms-2 order-lg-3 my-2 btnDelete" data-id="{{ $id }}" href="#">
                    Delete
                </a>
                @endif
{{--                @break--}}
{{--            @endforeach--}}
        @endif


    </div>
</div>
