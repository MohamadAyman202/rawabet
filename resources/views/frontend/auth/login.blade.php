@extends('frontend.layouts.master')
@section('css')
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/login.css') }}">
@endsection
@section('title', __('web.login'))
@section('content')
    <section class="login-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-6 col-12">
                    <div class="card">
                        <div class="card-body p-5">
                            @include('inc.message')
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="col-md-12">
                                    <h3 class="m-0">
                                        <p class="m-1">Welcome To Back!</p>
                                    </h3>
                                    <h4 class="">
                                        <p class="text-primary fw-bold">Customer</p>
                                    </h4>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <input id="email" type="email"
                                            class="form-control @error('email') is-invalid @enderror" name="email"
                                            value="{{ old('email') }}" required autocomplete="email" autofocus>

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <input id="password" type="password"
                                            class="form-control @error('password') is-invalid @enderror" name="password"
                                            required autocomplete="current-password">

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                                {{ old('remember') ? 'checked' : '' }}>

                                            <label class="form-check-label" for="remember">
                                                {{ __('Remember Me') }}
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 text-end">
                                        @if (Route::has('password.request'))
                                            <a class="btn btn-link p-0" href="{{ route('password.request') }}">
                                                {{ __('Forgot Your Password?') }}
                                            </a>
                                        @endif
                                    </div>
                                </div>

                                <div class="row mb-0">
                                    <div class="col-md-12 text-center">
                                        <button type="submit" class="btn btn-primary px-5">
                                            {{ __('Login') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
