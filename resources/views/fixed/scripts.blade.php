<!-- Vendor scrits: js libraries and plugins-->
<script src="{{ asset('assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/vendor/simplebar/dist/simplebar.min.js') }} "></script>
<script src="{{ asset('assets/vendor/smooth-scroll/dist/smooth-scroll.polyfills.min.js') }}"></script>
<script src="{{ asset('assets/vendor/tiny-slider/dist/min/tiny-slider.js') }}"></script>
<script src="{{ asset('assets/vendor/jarallax/dist/jarallax.min.js') }}"></script>
<script src="{{ asset('assets/vendor/jarallax/dist/jarallax-element.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" referrerpolicy="no-referrer">
    var token = {{ csrf_token() }}
</script>
<!-- Main theme script-->
<script src="{{ asset('assets/js/theme.min.js') }}"></script>
@yield('scripts')

</body>
</html>
