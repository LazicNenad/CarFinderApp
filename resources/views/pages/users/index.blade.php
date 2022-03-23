@extends('layouts.front.layout')

@section('content')

    <div class="container pt-5 pb-lg-4 mt-5 mb-sm-2">
        <!-- Breadcrumb-->
        <nav class="mb-4 pt-md-3" aria-label="Breadcrumb">
            <ol class="breadcrumb breadcrumb-light">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Account</a></li>
                <li class="breadcrumb-item active" id="breadcrumb" aria-current="page">Personal Info</li>
            </ol>
        </nav>
        <!-- Page content-->
        <div class="row">
            <!-- Sidebar-->
            <aside class="col-lg-4 col-md-5 pe-xl-4 mb-5">
                <!-- Account nav-->
                <div class="card card-body card-light border-0 shadow-sm pb-1 me-lg-1">
                    <div class="d-flex d-md-block d-lg-flex align-items-start pt-lg-2 mb-4"><img class="rounded-circle" src="{{ session()->get('user')->photo != null ? asset('storage/img/' . session()->get('user')->id . '/profile/' . session()->get('user')->photo) : asset('assets/img/default.jpg') }}" width="48" alt="{{ session()->get('user')->first_name . ' ' . session()->get('user')->last_name  }}">
                        <div class="pt-md-2 pt-lg-0 ps-3 ps-md-0 ps-lg-3">
                            <h2 class="fs-lg text-light mb-0">{{ session()->get('user')->first_name . ' ' . session()->get('user')->last_name  }}</h2>
                            <ul class="list-unstyled fs-sm mt-3 mb-0">
                                <li><a class="nav-link-light fw-normal" href="tel:{{ session()->get('user')->phone }}"><i class="fi-phone opacity-60 me-2"></i>{{ session()->get('user')->phone }}</a></li>
                                <li><a class="nav-link-light fw-normal" href="mailto:{{ session()->get('user')->email }}"><i class="fi-mail opacity-60 me-2"></i>{{ session()->get('user')->email }}</a></li>
                            </ul>
                        </div>
                    </div><a class="btn btn-primary btn-lg w-100 mb-3" href="{{ route('cars.create') }}"><i class="fi-plus me-2"></i>Sell car</a><a class="btn btn-outline-light d-block d-md-none w-100 mb-3" href="car-finder-account-info.html#account-nav" data-bs-toggle="collapse"><i class="fi-align-justify me-2"></i>Menu</a>
                    <div class="collapse d-md-block mt-3" id="account-nav">
                        <div class="card-nav">
                            <a class="card-nav-link d active" id="personal-info-btn" href="car-finder-account-info.html">
                                <i class="fi-user me-2"></i>Personal Info</a>
                            <a class="card-nav-link d" id="password-security-btn" href="car-finder-account-security.html">
                                <i class="fi-lock me-2"></i>Password &amp; Security</a>
                            <a class="card-nav-link d" id="my-cars-btn" href="car-finder-account-cars.html">
                                <i class="fi-car me-2"></i>My Cars</a>
                            <a class="card-nav-link d" id="wishlist-btn" href="car-finder-account-wishlist.html">
                                <i class="fi-heart me-2"></i>Wishlist<span class="badge bg-faded-light ms-2">4</span></a>
                            <a class="card-nav-link" href="{{ route('signout') }}">
                                <i class="fi-logout me-2"></i>Sign Out</a>
                        </div>
                    </div>
                </div>
            </aside>
            <!-- Content Personal Info-->
            <div class="col-lg-8 col-md-7 mb-5" id="personal-info">
                <h1 class="h2 text-light">Personal Info</h1>
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
                <form action="{{ route('users.update', ['user' => session()->get('user')->id]) }}" method="post" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                <div class="row pt-2">

                    <div class="col-lg-9 col-md-12 col-sm-8 mb-2 mb-m-4">
                        <div class="border border-light rounded-3 p-3 mb-4" >
                            <!-- Name-->
                            <div class="border-bottom border-light pb-3 mb-3">
                                <div class="d-flex align-items-center justify-content-between"      >
                                    <div class="pe-2 opacity-70">
                                        <label class="form-label fw-bold text-light">First Name</label>
                                        <div class="text-light" id="name-value">{{ session()->get('user')->first_name }}</div>
                                    </div>
                                    <div class="me-n3" data-bs-toggle="tooltip" title="Edit"><a class="nav-link nav-link-light py-0" href="car-finder-account-info.html#name-collapse" data-bs-toggle="collapse"><i class="fi-edit"></i></a></div>
                                </div>
                                <div class="collapse" id="name-collapse" data-bs-parent="#personal-info">
                                    <input class="form-control form-control-light mt-3" name="first_name" type="text" data-bs-binded-element="#name-value" data-bs-unset-value="Not specified" value="{{ session()->get('user')->first_name }}">
                                </div>
                            </div>

                            <div class="border-bottom border-light pb-3 mb-3">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="pe-2 opacity-70">
                                        <label class="form-label fw-bold text-light">Last Name</label>
                                        <div class="text-light" id="lastname-value">{{ session()->get('user')->last_name }}</div>
                                    </div>
                                    <div class="me-n3" data-bs-toggle="tooltip" title="Edit"><a class="nav-link nav-link-light py-0" href="car-finder-account-info.html#lastname-collapse" data-bs-toggle="collapse"><i class="fi-edit"></i></a></div>
                                </div>
                                <div class="collapse" id="lastname-collapse" data-bs-parent="#personal-info">
                                    <input class="form-control form-control-light mt-3" name="last_name" type="text" data-bs-binded-element="#lastname-value" data-bs-unset-value="Not specified" value="{{ session()->get('user')->last_name }}">
                                </div>
                            </div>

                            <!-- Email-->
                            <div class="border-bottom border-light pb-3 mb-3">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="pe-2 opacity-70">
                                        <label class="form-label fw-bold text-light">Email</label>
                                        <div class="text-light" id="email-value">{{ session()->get('user')->email }}</div>
                                    </div>
                                    <div class="me-n3" data-bs-toggle="tooltip" title="Edit"><a class="nav-link nav-link-light py-0" href="car-finder-account-info.html#email-collapse" data-bs-toggle="collapse"><i class="fi-edit"></i></a></div>
                                </div>
                                <div class="collapse" id="email-collapse" data-bs-parent="#personal-info">
                                    <input class="form-control form-control-light mt-3" name="email" type="email" data-bs-binded-element="#email-value" data-bs-unset-value="Not specified" value="{{ session()->get('user')->email }}">
                                </div>
                            </div>
                            <!-- Phone number-->
                            <div class="border-bottom border-light pb-3 mb-3">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="pe-2 opacity-70">
                                        <label class="form-label fw-bold text-light">Phone number</label>
                                        <div class="text-light" id="phone-value">{{ session()->get('user')->phone }}</div>
                                    </div>
                                    <div class="me-n3" data-bs-toggle="tooltip" title="Edit"><a class="nav-link nav-link-light py-0" href="car-finder-account-info.html#phone-collapse" data-bs-toggle="collapse"><i class="fi-edit"></i></a></div>
                                </div>
                                <div class="collapse" id="phone-collapse" data-bs-parent="#personal-info">
                                    <input class="form-control form-control-light mt-3" name="phone" type="text" data-bs-binded-element="#phone-value" data-bs-unset-value="Not specified" value="{{ session()->get('user')->phone }}">
                                </div>
                            </div>

                            <div class="border-bottom border-light pb-3 mb-3">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="pe-2 opacity-70">
                                        <label class="form-label fw-bold text-light">Profile picture</label>
                                        <input class="file-uploader border-light bg-faded-light" name="profile_picture" type="file" accept="image/png, image/jpeg" data-label-idle="&lt;i class=&quot;d-inline-block fi-camera-plus fs-2 text-light text-muted mb-2&quot;&gt;&lt;/i&gt;&lt;br&gt;&lt;span class=&quot;fw-bold text-light opacity-70&quot;&gt;Change picture&lt;/span&gt;" data-style-panel-layout="compact" data-image-preview-height="160" data-image-crop-aspect-ratio="1:1" data-image-resize-target-width="200" data-image-resize-target-height="200">
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
                <!-- Action buttons-->
                <div class="row">
                    <div class="col-lg-9">
                        <div class="d-flex align-items-center justify-content-between pb-1">
                            <button class="btn btn-primary" type="submit">Save changes</button>
                            <button class="btn btn-link btn-light btn-sm px-0" type="button"><i class="fi-trash me-2"></i>Delete account</button>
                        </div>
                    </div>
                </div>
                </form>
            </div>

            <!-- Content Password & Security -->
            <div class="col-lg-8 col-md-7 mb-5" id="password-security">
                <h1 class="h2 text-light">Password &amp; Security</h1>
                <p class="text-light pt-1">Manage your password settings and secure your account.</p>
                <h2 class="h5 text-light">Password</h2>
                <form class="needs-validation pb-4" action="{{ route('users.updatePassword', ['id' => session()->get('user')->id]) }}" method="post" novalidate>
                    @csrf
                    @method('put')
                    <div class="row align-items-end mb-2">
                        <div class="col-sm-6 mb-2">
                            <label class="form-label text-light" for="account-password">Current password</label>
                            <div class="password-toggle">
                                <input class="form-control form-control-light" name="current_password" type="password" id="account-password" required>
                                <label class="password-toggle-btn" aria-label="Show/hide password">
                                    <input class="password-toggle-check" name="current_password" type="checkbox"><span class="password-toggle-indicator"></span>
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-6 mb-2"><a class="d-inline-block text-light mb-2" href="car-finder-account-security.html#">Forgot password?</a></div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-sm-6 mb-3">
                            <label class="form-label text-light" for="account-password-new">New password</label>
                            <div class="password-toggle">
                                <input class="form-control form-control-light" name="new_password" type="password" id="account-password-new" required>
                                <label class="password-toggle-btn" aria-label="Show/hide password">
                                    <input class="password-toggle-check" type="checkbox"><span class="password-toggle-indicator"></span>
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-6 mb-3">
                            <label class="form-label text-light" for="account-password-confirm">Confirm password</label>
                            <div class="password-toggle">
                                <input class="form-control form-control-light" name="new_password_repeat" type="password" id="account-password-confirm" required>
                                <label class="password-toggle-btn" aria-label="Show/hide password">
                                    <input class="password-toggle-check" type="checkbox"><span class="password-toggle-indicator"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-outline-primary" type="submit">Update password</button>
                </form>
            </div>

            <!-- Content My Cars -->
            <div class="col-lg-8 col-md-7 mb-5" id="my-cars">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <h1 class="h2 text-light mb-0">My Cars</h1><a class="nav-link-light fw-bold" href="car-finder-account-cars.html#"><i class="fi-trash mt-n1 me-2"></i>Delete all</a>
                </div>
                <p class="text-light pt-1 mb-4">Here you can see your car offers and edit them easily.</p>
                @php
                    $userCars = \App\Models\Car::where('user_id', session()->get('user')->id)->get();
                @endphp
                @forelse($userCars as $one)
                <!-- Item-->
                <div class="card card-light card-hover card-horizontal mb-4">
                    <div class="tns-carousel-wrapper card-img-top card-img-hover"><a class="img-overlay" href="{{ route('cars.show', ['car' => $one->id]) }}"></a>
                        <div class="position-absolute start-0 top-0 pt-3 ps-3"><span class="d-table badge bg-info">{{ $one->new }}</span></div>
                        <div class="content-overlay end-0 top-0 pt-3 pe-3">
                            <button class="btn btn-icon btn-light btn-xs text-primary rounded-circle" type="button" data-bs-toggle="tooltip" data-bs-placement="left" title="Add to Wishlist"><i class="fi-heart"></i></button>
                        </div>
                        <div class="tns-carousel-inner position-absolute top-0 h-100">
                            @foreach($one->car_images as $image)
                            <div class="bg-size-cover bg-position-center w-100 h-100" style="background-image: url('{{ asset('storage/img/' . session()->get('user')->id . '/' . $image->image) }}');"></div>
                            @endforeach

                        </div>
                    </div>
                    <div class="card-body position-relative">
                        <div class="dropdown position-absolute zindex-5 top-0 end-0 mt-3 me-3">
                            <button class="btn btn-icon btn-translucent-light btn-xs rounded-circle" type="button" id="contextMenu1" data-bs-toggle="dropdown" aria-expanded="false"><i class="fi-dots-vertical"></i></button>
                            <ul class="dropdown-menu dropdown-menu-dark my-1" aria-labelledby="contextMenu1">
                                <li>
                                    <a class="dropdown-item" href="{{ route('cars.edit', ['car' => $one->id]) }}"><i class="fi-edit me-2"></i>Edit</a>
                                </li>
                                <li>
                                    <form action="{{ route('cars.destroy', ['car' => $one->id]) }}" method="post">
                                        @csrf
                                        @method('delete')
                                    <button class="dropdown-item" type="submit"><i class="fi-trash me-2"></i>Delete</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                        <div class="fs-sm text-light pb-1">{{ $one->year }}</div>
                        <h3 class="h6 mb-1"><a class="nav-link-light" href="{{ route('cars.show', ['car' => $one->id]) }}">{{ $one->title }}</a></h3>
                        <div class="text-primary fw-bold mb-1">{{ $one->price }} $</div>
                        <div class="fs-sm text-light opacity-70"><i class="fi-map-pin me-1"></i>{{ $one->user->location->location }}</div>
                        <div class="border-top border-light mt-3 pt-3">
                            <div class="row g-2">
                                <div class="col me-sm-1">
                                    <div class="bg-dark rounded text-center w-100 h-100 p-2"><i class="fi-dashboard d-block h4 text-light mb-0 mx-center"></i><span class="fs-xs text-light">{{ $one->mileage }} km</span></div>
                                </div>
                                <div class="col me-sm-1">
                                    <div class="bg-dark rounded text-center w-100 h-100 p-2"><i class="fi-gearbox d-block h4 text-light mb-0 mx-center"></i><span class="fs-xs text-light">{{ $one->transmission }}</span></div>
                                </div>
                                <div class="col">
                                    <div class="bg-dark rounded text-center w-100 h-100 p-2"><i class="fi-petrol d-block h4 text-light mb-0 mx-center"></i><span class="fs-xs text-light">{{ $one->gas->gas }}</span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                    @empty

                    <div class="alert alert-danger">
                        <h3>You dont have cars, <a href="{{ route('cars.create') }}">click to sell your first car!</a></h3>
                    </div>
                @endforelse
            </div>

            <!-- Content wishlist-->
            <div class="col-lg-8 col-md-7 mb-5" id="wishlist">
                <div class="d-flex align-items-center justify-content-between mb-4 pb-2">
                    <h1 class="h2 text-light mb-0">Wishlist<span class="badge bg-faded-light fs-base align-middle ms-3">4</span></h1><a class="nav-link-light fw-bold" href="car-finder-account-wishlist.html#"><i class="fi-x fs-xs mt-n1 me-2"></i>Clear all</a>
                </div>
                <!-- Item-->
                <div class="card card-light card-hover card-horizontal mb-4">
                    <div class="tns-carousel-wrapper card-img-top card-img-hover"><a class="img-overlay" href="car-finder-single.html"></a>
                        <div class="position-absolute start-0 top-0 pt-3 ps-3"><span class="d-table badge bg-info">Used</span></div>
                        <div class="position-absolute end-0 top-0 pt-3 pe-3 zindex-5">
                            <button class="btn btn-icon btn-light btn-xs text-primary rounded-circle shadow-sm" type="button" data-bs-toggle="tooltip" data-bs-placement="left" title="Remove from Wishlist"><i class="fi-heart-filled"></i></button>
                        </div>
                        <div class="tns-carousel-inner position-absolute top-0 h-100">
                            <div class="bg-size-cover bg-position-center w-100 h-100" style="background-image: url(img/car-finder/catalog/09.jpg);"></div>
                            <div class="bg-size-cover bg-position-center w-100 h-100" style="background-image: url(img/car-finder/catalog/09.jpg);"></div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between pb-1"><span class="fs-sm text-light me-3">1995</span>
                            <div class="form-check form-check-light">
                                <input class="form-check-input" type="checkbox" id="compare1">
                                <label class="form-check-label fs-sm" for="compare1">Compare</label>
                            </div>
                        </div>
                        <h3 class="h6 mb-1"><a class="nav-link-light" href="car-finder-single.html">Ford Truck Lifted</a></h3>
                        <div class="text-primary fw-bold mb-1">$24,000</div>
                        <div class="fs-sm text-light opacity-70"><i class="fi-map-pin me-1"></i>New Jersey</div>
                        <div class="border-top border-light mt-3 pt-3">
                            <div class="row g-2">
                                <div class="col me-sm-1">
                                    <div class="bg-dark rounded text-center w-100 h-100 p-2"><i class="fi-dashboard d-block h4 text-light mb-0 mx-center"></i><span class="fs-xs text-light">278K mi</span></div>
                                </div>
                                <div class="col me-sm-1">
                                    <div class="bg-dark rounded text-center w-100 h-100 p-2"><i class="fi-gearbox d-block h4 text-light mb-0 mx-center"></i><span class="fs-xs text-light">Manual</span></div>
                                </div>
                                <div class="col">
                                    <div class="bg-dark rounded text-center w-100 h-100 p-2"><i class="fi-petrol d-block h4 text-light mb-0 mx-center"></i><span class="fs-xs text-light">Diesel</span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Item-->
                <div class="card card-light card-hover card-horizontal mb-4">
                    <div class="tns-carousel-wrapper card-img-top card-img-hover"><a class="img-overlay" href="car-finder-single.html"></a>
                        <div class="position-absolute start-0 top-0 pt-3 ps-3"><span class="d-table badge bg-info mb-1">Used</span><span class="d-table badge bg-success mb-1" data-bs-toggle="popover" data-bs-placement="bottom" data-bs-trigger="hover" data-bs-html="true" data-bs-content="&lt;div class=&quot;d-flex&quot;&gt;&lt;i class=&quot;fi-award mt-1 me-2&quot;&gt;&lt;/i&gt;&lt;div&gt;This car is checked and&lt;br&gt;certified by Finder.&lt;/div&gt;&lt;/div&gt;">Certified</span></div>
                        <div class="position-absolute end-0 top-0 pt-3 pe-3 zindex-5">
                            <button class="btn btn-icon btn-light btn-xs text-primary rounded-circle shadow-sm" type="button" data-bs-toggle="tooltip" data-bs-placement="left" title="Remove from Wishlist"><i class="fi-heart-filled"></i></button>
                        </div>
                        <div class="tns-carousel-inner position-absolute top-0 h-100">
                            <div class="bg-size-cover bg-position-center w-100 h-100" style="background-image: url(img/car-finder/catalog/10.jpg);"></div>
                            <div class="bg-size-cover bg-position-center w-100 h-100" style="background-image: url(img/car-finder/catalog/10.jpg);"></div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between pb-1"><span class="fs-sm text-light me-3">2018</span>
                            <div class="form-check form-check-light">
                                <input class="form-check-input" type="checkbox" id="compare2">
                                <label class="form-check-label fs-sm" for="compare2">Compare</label>
                            </div>
                        </div>
                        <h3 class="h6 mb-1"><a class="nav-link-light" href="car-finder-single.html">Mercedes Benz C300 Sport</a></h3>
                        <div class="text-primary fw-bold mb-1">$53,600</div>
                        <div class="fs-sm text-light opacity-70"><i class="fi-map-pin me-1"></i>San Francisco</div>
                        <div class="border-top border-light mt-3 pt-3">
                            <div class="row g-2">
                                <div class="col me-sm-1">
                                    <div class="bg-dark rounded text-center w-100 h-100 p-2"><i class="fi-dashboard d-block h4 text-light mb-0 mx-center"></i><span class="fs-xs text-light">35K mi</span></div>
                                </div>
                                <div class="col me-sm-1">
                                    <div class="bg-dark rounded text-center w-100 h-100 p-2"><i class="fi-gearbox d-block h4 text-light mb-0 mx-center"></i><span class="fs-xs text-light">Automatic</span></div>
                                </div>
                                <div class="col">
                                    <div class="bg-dark rounded text-center w-100 h-100 p-2"><i class="fi-petrol d-block h4 text-light mb-0 mx-center"></i><span class="fs-xs text-light">Hybrid</span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Item-->
                <div class="card card-light card-hover card-horizontal mb-4">
                    <div class="tns-carousel-wrapper card-img-top card-img-hover"><a class="img-overlay" href="car-finder-single.html"></a>
                        <div class="position-absolute start-0 top-0 pt-3 ps-3"><span class="d-table badge bg-info">Used</span></div>
                        <div class="position-absolute end-0 top-0 pt-3 pe-3 zindex-5">
                            <button class="btn btn-icon btn-light btn-xs text-primary rounded-circle shadow-sm" type="button" data-bs-toggle="tooltip" data-bs-placement="left" title="Remove from Wishlist"><i class="fi-heart-filled"></i></button>
                        </div>
                        <div class="tns-carousel-inner position-absolute top-0 h-100">
                            <div class="bg-size-cover bg-position-center w-100 h-100" style="background-image: url(img/car-finder/catalog/11.jpg);"></div>
                            <div class="bg-size-cover bg-position-center w-100 h-100" style="background-image: url(img/car-finder/catalog/11.jpg);"></div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between pb-1"><span class="fs-sm text-light me-3">2019</span>
                            <div class="form-check form-check-light">
                                <input class="form-check-input" type="checkbox" id="compare3">
                                <label class="form-check-label fs-sm" for="compare3">Compare</label>
                            </div>
                        </div>
                        <h3 class="h6 mb-1"><a class="nav-link-light" href="car-finder-single.html">Mazda MX-5 Miata Convertible</a></h3>
                        <div class="text-primary fw-bold mb-1">$29,700</div>
                        <div class="fs-sm text-light opacity-70"><i class="fi-map-pin me-1"></i>Los Angeles</div>
                        <div class="border-top border-light mt-3 pt-3">
                            <div class="row g-2">
                                <div class="col me-sm-1">
                                    <div class="bg-dark rounded text-center w-100 h-100 p-2"><i class="fi-dashboard d-block h4 text-light mb-0 mx-center"></i><span class="fs-xs text-light">18K mi</span></div>
                                </div>
                                <div class="col me-sm-1">
                                    <div class="bg-dark rounded text-center w-100 h-100 p-2"><i class="fi-gearbox d-block h4 text-light mb-0 mx-center"></i><span class="fs-xs text-light">Manual</span></div>
                                </div>
                                <div class="col">
                                    <div class="bg-dark rounded text-center w-100 h-100 p-2"><i class="fi-petrol d-block h4 text-light mb-0 mx-center"></i><span class="fs-xs text-light">Gasoline</span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Item-->
                <div class="card card-light card-hover card-horizontal">
                    <div class="tns-carousel-wrapper card-img-top card-img-hover"><a class="img-overlay" href="car-finder-single.html"></a>
                        <div class="position-absolute start-0 top-0 pt-3 ps-3"><span class="d-table badge bg-info">Used</span></div>
                        <div class="position-absolute end-0 top-0 pt-3 pe-3 zindex-5">
                            <button class="btn btn-icon btn-light btn-xs text-primary rounded-circle shadow-sm" type="button" data-bs-toggle="tooltip" data-bs-placement="left" title="Remove from Wishlist"><i class="fi-heart-filled"></i></button>
                        </div>
                        <div class="tns-carousel-inner position-absolute top-0 h-100">
                            <div class="bg-size-cover bg-position-center w-100 h-100" style="background-image: url(img/car-finder/catalog/12.jpg);"></div>
                            <div class="bg-size-cover bg-position-center w-100 h-100" style="background-image: url(img/car-finder/catalog/12.jpg);"></div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between pb-1"><span class="fs-sm text-light me-3">2016</span>
                            <div class="form-check form-check-light">
                                <input class="form-check-input" type="checkbox" id="compare4">
                                <label class="form-check-label fs-sm" for="compare4">Compare</label>
                            </div>
                        </div>
                        <h3 class="h6 mb-1"><a class="nav-link-light" href="car-finder-single.html">Nissan 370Z Nismo </a></h3>
                        <div class="text-primary fw-bold mb-1">$31,200</div>
                        <div class="fs-sm text-light opacity-70"><i class="fi-map-pin me-1"></i>New York</div>
                        <div class="border-top border-light mt-3 pt-3">
                            <div class="row g-2">
                                <div class="col me-sm-1">
                                    <div class="bg-dark rounded text-center w-100 h-100 p-2"><i class="fi-dashboard d-block h4 text-light mb-0 mx-center"></i><span class="fs-xs text-light">16K mi</span></div>
                                </div>
                                <div class="col me-sm-1">
                                    <div class="bg-dark rounded text-center w-100 h-100 p-2"><i class="fi-gearbox d-block h4 text-light mb-0 mx-center"></i><span class="fs-xs text-light">Automatic</span></div>
                                </div>
                                <div class="col">
                                    <div class="bg-dark rounded text-center w-100 h-100 p-2"><i class="fi-petrol d-block h4 text-light mb-0 mx-center"></i><span class="fs-xs text-light">Gasoline</span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('scripts')
    <script src="{{ asset('assets/js/user.js') }}"></script>
@endsection
