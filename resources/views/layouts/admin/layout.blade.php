@include('fixed.admin.head')

<!--**********************************
    Main wrapper start
***********************************-->
<div id="main-wrapper">
    <!--**********************************
        Nav header start
    ***********************************-->
    <div class="nav-header d-flex justify-content-center align-items-center">
        <a class="navbar-brand me-3 me-xl-4" href="{{ route('admin.index') }}"><img class="d-block" src="{{ asset('assets/img/logo/logo-light.svg') }}" width="116" alt="Finder"></a>
        <div class="nav-control">
            <div class="hamburger">
                <span class="line"></span><span class="line"></span><span class="line"></span>
            </div>
        </div>
    </div>
    <!--**********************************
        Nav header end
    ***********************************-->

    <!--**********************************
        Header start
    ***********************************-->
    <div class="header">
        <div class="header-content">
            <nav class="navbar navbar-expand">
                <div class="collapse navbar-collapse justify-content-between">
                    <div class="header-left">
                        <div class="search_bar dropdown">
                                <span class="search_icon p-3 c-pointer" data-toggle="dropdown">
                                    <i class="mdi mdi-magnify"></i>
                                </span>
                            <div class="dropdown-menu p-0 m-0">
                                <form>
                                    <input class="form-control" type="search" placeholder="Search" aria-label="Search">
                                </form>
                            </div>
                        </div>
                    </div>

                    <ul class="navbar-nav header-right">
                        <li class="nav-item dropdown header-profile">
                            <a href="{{ route('users.index') }}">{{ session()->get('user')->first_name . ' ' . session()->get('user')->last_name}}</a>
                            <a class="d-block py-2 nav-link" href="{{ route('users.index') }}"><img class="rounded-circle" src="{{ session()->get('user')->photo != null ? asset('storage/img/' . session()->get('user')->id . '/profile/' . session()->get('user')->photo) : asset('assets/img/default.jpg') }}" width="40" alt="{{ session()->get('user')->first_name . session()->get('user')->last_name }}"></a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>
    <!--**********************************
        Header end ti-comment-alt
    ***********************************-->

    <!--**********************************
        Sidebar start
    ***********************************-->
    <div class="quixnav">
        <div class="quixnav-scroll">
            <ul class="metismenu" id="menu">
                <li class="nav-label first">Main Menu</li>
                <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                            class="icon icon-single-04"></i><span class="nav-text">User</span></a>
                    <ul aria-expanded="false">
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li><a href="{{ route('signout') }}">Sign out</a></li>
                    </ul>
                </li>
                <li class="nav-label">Tables</li>
                <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                            class="icon icon-layout-25"></i><span class="nav-text">Tables</span></a>
                    <ul aria-expanded="false">
                        <li><a href="{{ route('adminCar.index') }}">Cars</a></li>
                        <li><a href="{{ route('adminUser.index') }}">Users</a></li>
                        <li><a href="{{ route('location.index') }}">Locations</a></li>
                    </ul>
                </li>
                <li class="nav-label">Logs</li>
                <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                            class="icon"></i><span class="nav-text">Logs</span></a>
                    <ul aria-expanded="false">
                        <li><a href="{{ route('admin.log') }}">All logs</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
    <!--**********************************
        Sidebar end
    ***********************************-->

    <!--**********************************
        Content body start
    ***********************************-->
    <div class="content-body">
        @yield('content-admin')
    </div>
    <!--**********************************
        Content body end
    ***********************************-->


    <!--**********************************
        Footer start
    ***********************************-->
   @include('fixed.admin.footer')
    <!--**********************************
        Footer end
    ***********************************-->

</div>
<!--**********************************
    Main wrapper end
***********************************-->

@include('fixed.admin.scripts')

@yield('scripts')
