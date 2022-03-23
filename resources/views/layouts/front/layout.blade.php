@include('fixed.head')
@include('fixed.loader')

<main class="page-wrapper">
    @include('fixed.sign_in_modal')
    @include('fixed.sign_up_modal')
    @include('fixed.nav')

    @yield('content')
</main>


@include('fixed.footer')
@include('fixed.scripts')
