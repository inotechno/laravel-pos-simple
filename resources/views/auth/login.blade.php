@extends('layouts.auth')

@section('content')
    <div class="auth-wrapper d-flex no-block justify-content-center align-items-center position-relative"
        style="background:url(../assets/images/big/auth-bg.jpg) no-repeat center center;">
        <div class="auth-box row">
            <div class="col-lg-7 col-md-5 modal-bg-img" style="background-image: url(../assets/images/big/3.jpg);">
            </div>
            <div class="col-lg-5 col-md-7 bg-white">
                <div class="p-3">
                    <div class="text-center">
                        <img src="../assets/images/big/icon.png" alt="wrapkit">
                    </div>
                    <h2 class="mt-3 text-center">Sign In</h2>
                    <p class="text-center">Enter your email address and password to access admin panel.</p>
                    <form class="mt-4" action="{{ route('login.process') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="text-dark" for="uname">Email</label>
                                    <input class="form-control @error('email') is-invalid @enderror" id="uname"
                                        name="email" type="text" placeholder="enter your email">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="text-dark" for="pwd">Password</label>
                                    <input class="form-control @error('password') is-invalid @enderror" id="pwd"
                                        type="password" name="password" placeholder="enter your password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-12 text-center">
                                <button type="submit" class="btn btn-block btn-dark">Sign In</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $(".preloader ").fadeOut();
    </script>
@endpush
