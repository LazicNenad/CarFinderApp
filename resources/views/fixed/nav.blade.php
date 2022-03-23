<!-- Navbar-->
<header class="navbar navbar-expand-lg navbar-dark fixed-top" data-scroll-header>
    <div class="container"><a class="navbar-brand me-3 me-xl-4" href="{{ route('home') }}"><img class="d-block" src="{{ asset('assets/img/logo/logo-light.svg') }}" width="116" alt="Finder"></a>
        <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        @if(session()->has('user'))
            <div class="dropdown d-none d-lg-block order-lg-3 my-n2 me-3"><a class="d-block py-2" href="{{ route('users.index') }}"><img class="rounded-circle" src="{{ session()->get('user')->photo != null ? asset('storage/img/' . session()->get('user')->id . '/profile/' . session()->get('user')->photo) : asset('assets/img/default.jpg') }}" width="40" alt="{{ session()->get('user')->first_name . session()->get('user')->last_name }}"></a>
                <div class="dropdown-menu dropdown-menu-dark dropdown-menu-end">
                    <div class="d-flex align-items-start border-bottom border-light px-3 py-1 mb-2" style="width: 16rem;"><img class="rounded-circle" src="{{ session()->get('user')->photo != null ? asset('storage/img/' . session()->get('user')->id . '/profile/' . session()->get('user')->photo) : asset('assets/img/default.jpg') }}" width="48" alt={{ session()->get('user')->first_name . session()->get('user')->last_name }}">
                        <div class="ps-2">
                            <h6 class="fs-base text-light mb-0">{{ session()->get('user')->first_name . ' ' . session()->get('user')->last_name }}</h6>
                            <div class="fs-xs py-2">{{ session()->get('user')->email }}</div>
                            <div class="fs-xs py-2">{{ session()->get('user')->location->location }}</div>
                        </div>
                    </div>
                <a class="dropdown-item" href="{{ route('users.index') }}"><i class="fi-user me-2"></i>Personal Info</a>
                <a class="dropdown-item" href="{{ route('users.index') }}"><i class="fi-lock me-2"></i>Password &amp; Security</a>
                <a class="dropdown-item" href="{{ route('users.index') }}"><i class="fi-heart me-2"></i>Wishlist<span class="badge bg-faded-light ms-2">4</span></a>
                <a class="dropdown-item" href="{{ route('users.index') }}"><i class="fi-car me-2"></i>My Cars</a>
                    <div class="dropdown-divider"></div><a class="dropdown-item" href="{{ route('signout') }}">Sign Out</a>
                </div>
            </div>
        @else
            <a class="btn btn-link btn-light btn-sm d-none d-lg-block order-lg-3" href="{{ route('home') . '#signin-modal' }}" data-bs-toggle="modal">
                <i class="fi-user me-2"></i>Sign in</a>
        @endif

        @if(session()->get('user'))
        <a class="btn btn-primary btn-sm ms-2 order-lg-3" href="{{ route('cars.create') }}">
            <i class="fi-plus me-2"></i>Sell car
        </a>
        @endif
        <div class="collapse navbar-collapse order-lg-2" id="navbarNav">
            <ul class="navbar-nav navbar-nav-scroll" style="max-height: 35rem;">
                <!-- Menu items-->
                <li class="nav-item active"><a class="nav-link" href="{{ route('home') }}">Home</a></li>
                <li class="nav-item "><a class="nav-link" href="{{ route('cars.index') }}">Cars</a></li>
                @if(session()->has('user') && session()->get('user')->role->role === 'Admin')
                    <li class="nav-item bg-primary"><a class="nav-link" href="{{ route('admin.index') }}">Admin</a></li>
                @endif
                <li class="nav-item dropdown"><a class="nav-link dropdown-toggle" href="{{ route('home') }}" role="button" data-bs-toggle="dropdown" aria-expanded="false">Account</a>
                    <ul class="dropdown-menu dropdown-menu-dark">
                        <li><a class="dropdown-item" href="{{ route('users.index') }}">Personal Info</a></li>
                        <li><a class="dropdown-item" href="{{ route('users.index') }}">Password &amp; Security</a></li>
                        <li><a class="dropdown-item" href="{{ route('users.index') }}">Wishlist</a></li>
                        <li><a class="dropdown-item" href="{{ route('users.index') }}">My Cars</a></li>
                    </ul>
                </li>
                <li class="nav-item d-lg-none"><a class="nav-link" href="#" data-bs-toggle="modal"><i class="fi-user me-2"></i>Sign in</a></li>
            </ul>
        </div>
    </div>
</header>
