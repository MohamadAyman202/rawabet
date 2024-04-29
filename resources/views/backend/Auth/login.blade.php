@extends('backend.layouts.master2')
@section('css')
    <!-- Sidemenu-respoansive-tabs css -->
    <link href="{{ URL::asset('assets/plugins/sidemenu-responsive-tabs/css/sidemenu-responsive-tabs.css') }}"
        rel="stylesheet">
@stop
@section('title')
    Login
@stop
@section('content')
    @php
        $setting = App\Models\Setting::query()->value('favicon');
    @endphp
    <div class="container-fluid">
        <div class="row no-gutter justify-content-center">
            <!-- The content half -->
            <div class="col-md-6 col-lg-6 col-xl-5">
                <div class="login d-flex align-items-center py-2">
                    <!-- Demo content-->
                    <div class="container p-0">
                        <div class="row">
                            <div class="col-md-10 col-lg-10 col-xl-9 mx-auto bg-white p-5">
                                <div class="card-sigin">
                                    <div class="mb-3 d-flex"> <a href="{{ url('/' . ($page = 'index')) }}"><img
                                                src="{{ URL::asset($setting) }}" class="sign-favicon ht-60"
                                                alt="logo"></a>
                                    </div>
                                    <div class="card-sigin">
                                        <div class="main-signup-header">
                                            <h2>Welcome back!</h2>
                                            <h5 class="font-weight-semibold mb-4">Please sign in to continue.</h5>
                                            @if (Session::has('error'))
                                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                    <strong>Error!</strong> {{ Session::get('error') }}
                                                    <button type="button" class="close" data-dismiss="alert"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                            @endif
                                            <form action="{{ route('admin.login') }}" method="post">
                                                @csrf
                                                <div class="form-group">
                                                    <label>Email</label> <input class="form-control"
                                                        placeholder="Enter your email" name="email" type="text">
                                                </div>
                                                <div class="form-group">
                                                    <label>Password</label> <input class="form-control"
                                                        placeholder="Enter your password" name="password" type="password">
                                                </div><button class="btn btn-main-primary btn-block">Sign In</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- End -->
                </div>
            </div><!-- End -->
        </div>
    </div>
@endsection
@section('js')
@endsection
