<!-- Sign Up Modal-->


<div class="modal fade" id="signup-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered p-2 my-0 mx-auto" style="max-width: 950px;">
        <div class="modal-content bg-dark border-light">
            <div class="modal-body px-0 py-2 py-sm-0">
                <button class="btn-close btn-close-white position-absolute top-0 end-0 mt-3 me-3" type="button" data-bs-dismiss="modal"></button>
                <div class="row mx-0 align-items-center">
                    <div class="col-md-6 border-end-md border-light p-4 p-sm-5">
                        <h2 class="h3 text-light mb-4 mb-sm-5">Join Finder.<br>Get premium benefits:</h2>
                        <ul class="list-unstyled mb-4 mb-sm-5">
                            <li class="d-flex mb-2"><i class="fi-check-circle text-primary mt-1 me-2"></i><span class="text-light">Add and promote your listings</span></li>
                            <li class="d-flex mb-2"><i class="fi-check-circle text-primary mt-1 me-2"></i><span class="text-light">Easily manage your wishlist</span></li>
                            <li class="d-flex mb-0"><i class="fi-check-circle text-primary mt-1 me-2"></i><span class="text-light">Leave reviews</span></li>
                        </ul><img class="d-block mx-auto" src="{{ asset('assets/img/signin-modal/signup-dark.svg') }}" width="344" alt="Illustartion">
                        <div class="text-light mt-sm-4 pt-md-3"><span class="opacity-60">Already have an account? </span><a class="text-light" href="{{ route('home') . '#signin-modal' }}" data-bs-toggle="modal" data-bs-dismiss="modal">Sign in</a></div>
                    </div>
                    <div class="col-md-6 px-4 pt-2 pb-4 px-sm-5 pb-sm-5 pt-md-5"><a class="btn btn-outline-info w-100 mb-3" href="{{ route('home') }}"><i class="fi-google fs-lg me-1"></i>Sign in with Google</a><a class="btn btn-outline-info w-100 mb-3" href="{{ route('home') }}"><i class="fi-facebook fs-lg me-1"></i>Sign in with Facebook</a>
                        <div class="d-flex align-items-center py-3 mb-3">
                            <hr class="hr-light w-100">
                            <div class="text-light opacity-70 px-3">Or</div>
                            <hr class="hr-light w-100">
                        </div>
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form class="needs-validation" method="POST" action="{{ route('register') }}" novalidate>
                            @csrf
                            <div class="mb-3">
                                <label class="form-label text-light" for="signup-name">First Name</label>
                                <input class="form-control form-control-light" type="text" id="signup-name" name="first_name" placeholder="Enter your first name">
                            </div>

                            <div class="mb-3">
                                <label class="form-label text-light" for="signup-lastname">Last Name</label>
                                <input class="form-control form-control-light" type="text" id="signup-lastname" name="last_name" placeholder="Enter your last name" >
                            </div>

                            <div class="mb-3">
                                <label class="form-label text-light" for="signup-phone">Phone</label>
                                <input class="form-control form-control-light" type="text" id="signup-phone" name="phone" placeholder="Enter phone" >
                            </div>

                            <div class="mb-3">
                                <label class="form-label text-light" for="location">Select City</label>

                                <select name="location" id="location" class="form-control form-control-light">
                                    @foreach(\App\Models\Location::all() as $one)
                                        <option class="text-dark" value="{{ $one->id }}">{{ $one->location }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label text-light" for="signup-email">Email address</label>
                                <input class="form-control form-control-light" type="email" name="email" id="signup-email" placeholder="Enter your email" >
                            </div>
                            <div class="mb-3">
                                <label class="form-label text-light"  for="signup-password">Password</label>
                                <div class="password-toggle">
                                    <input class="form-control form-control-light" name="password" type="password" id="signup-password" >
                                    <label class="password-toggle-btn" aria-label="Show/hide password">
                                        <input class="password-toggle-check" type="checkbox"><span class="password-toggle-indicator"></span>
                                    </label>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label text-light"  for="signup-password_repeat">Password Repeat</label>
                                <div class="password-toggle">
                                    <input class="form-control form-control-light" name="password_repeat" type="password" id="signup-password_repeat" >
                                    <label class="password-toggle-btn" aria-label="Show/hide password">
                                        <input class="password-toggle-check" type="checkbox"><span class="password-toggle-indicator"></span>
                                    </label>
                                </div>
                            </div>

                            <input class="btn btn-primary btn-lg w-100" value="Sign Up" type="submit">

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
