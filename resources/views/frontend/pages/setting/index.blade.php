@extends('frontend.layouts.master')
@section('title', __('web.setting'))
@section('content')
    <section class="web-setting py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="row">
                        <div class="col-12 col-lg-8 col-md-8">
                            <div class="card">
                                <div class="card-body">
                                    @include('inc.message')
                                    <form action="{{ route('register') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">

                                            <div class="col-12 col-lg-6 col-md-6 col-xl-6">
                                                <h4>
                                                    {{ __('web.edit') }} <span
                                                        class="text-primary fw-bold ">{{ __('web.profile') }}</span>
                                                </h4>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-12 col-lg-6 col-md-6 col-xl-6">

                                                <div class="">
                                                    <label class="form-label">{{ __('web.name') }}</label>
                                                    <input class="form-control @error('name') is-invalid @enderror"
                                                        type="text" name="name" value="{{ $user->name }}"
                                                        placeholder="{{ __('web.name') }}" />
                                                    @error('name')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-12 col-lg-6 col-md-6 col-xl-6">
                                                <div class="">
                                                    <label class="form-label">{{ __('web.email') }}</label>
                                                    <input class="form-control @error('email') is-invalid @enderror"
                                                        type="email" autocomplete="email" name="email"
                                                        value="{{ $user->email }}" placeholder="{{ __('web.email') }}" />
                                                    @error('email')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-12 col-lg-6 col-md-6 col-xl-6">
                                                <div class="mt-3">
                                                    <label class="form-label">{{ __('web.password') }}</label>
                                                    <input class="form-control @error('password') is-invalid @enderror"
                                                        type="password" name="password" value="{{ old('password') }}"
                                                        placeholder="{{ __('web.password') }}" />
                                                    @error('password')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-12 col-lg-6 col-md-6 col-xl-6">
                                                <div class="mt-3">
                                                    <label class="form-label">{{ __('web.confirm_password') }}</label>
                                                    <input
                                                        class="form-control @error('confirm_password') is-invalid @enderror"
                                                        type="password" name="password_confirmation"
                                                        value="{{ old('confirm_password') }}"
                                                        placeholder="{{ __('web.confirm_password') }}" />
                                                    @error('password')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-12 col-lg-6 col-md-6 col-xl-6">
                                                <div class="mt-3">
                                                    <label class="form-label">{{ __('web.phone') }}</label>
                                                    <input class="form-control @error('phone') is-invalid @enderror"
                                                        type="tel" name="phone" value="{{ $user->phone }}"
                                                        placeholder="{{ __('web.phone') }}" />
                                                    @error('phone')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-12 col-lg-6 col-md-6 col-xl-6">
                                                <div class="mt-3">
                                                    <label for=""
                                                        class="form-label">{{ __('web.country') }}</label>
                                                    <select
                                                        class="form-control select2 @error('country_id') is-invalid @enderror"
                                                        name="country_id" id="country_id">
                                                        <option selected disabled>{{ __('web.country') }}</option>
                                                        @isset($countries)
                                                            @foreach ($countries as $country)
                                                                <option value="{{ $country->id }}"
                                                                    {{ $user->country_id == $country->id ? 'selected' : '' }}>
                                                                    {{ $country->emoji }}
                                                                    {{ app()->getLocale() == 'en' ? $country->name : $country->native }}
                                                                </option>
                                                            @endforeach
                                                        @endisset
                                                    </select>
                                                    @error('country_id')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-12 col-lg-6 col-md-6 col-xl-6">
                                                <div class="mt-3">
                                                    <label for="" class="form-label">{{ __('web.state') }}</label>
                                                    <select
                                                        class="form-control select2 @error('state') is-invalid @enderror"
                                                        name="state_id">
                                                        <option selected disabled>{{ __('web.state') }}</option>
                                                    </select>
                                                    @error('state_id')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-12 col-lg-6 col-md-6 col-xl-6">
                                                <div class="mt-3">
                                                    <label for="" class="form-label">{{ __('web.city') }}</label>
                                                    <select
                                                        class="form-control select2 @error('city_id') is-invalid @enderror"
                                                        name="city_id">
                                                        <option selected disabled>{{ __('web.city') }}</option>
                                                    </select>
                                                    @error('city_id')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-12 col-lg-12 col-md-12 col-xl-12">
                                                <div class="mt-3">
                                                    <label for=""
                                                        class="form-label">{{ __('web.address') }}</label>
                                                    <input type="text" placeholder="{{ __('web.address') }}"
                                                        name="address"
                                                        class="form-control @error('address') is-invalid @enderror"
                                                        placeholder="" aria-describedby="helpId" />
                                                    @error('address')
                                                        <small id="helpId" class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="mt-3">
                                                    <label for=""
                                                        class="form-label">{{ __('web.type_account') }}</label>
                                                    <input type="text" value="{{ $user->role_name }}" disabled
                                                        class="form-control">
                                                    @error('type_account')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-center mt-3">
                                            <button class="btn ripple btn-primary px-5"
                                                type="submit">{{ __('web.submit') }}</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-lg-4 col-md-4">
                            <div class="card card-body mb-3">
                                <h4>Last Login</h4>
                                @foreach ($lastLogin->last_logins as $last_login)
                                    <p class="d-inline-flex gap-1 w-100 my-2">
                                        <a href="#last-login-{{ $last_login->id }}" role="button"
                                            class="btn btn-primary p-2 w-100"
                                            data-bs-toggle="collapse">{{ $last_login->Fun($last_login->created_at) }}</a>
                                    </p>
                                    <div class="collapse" id="last-login-{{ $last_login->id }}">
                                        <div class="card card-body">
                                            <ul class="m-0">
                                                <li class="">Ip Address: {{ $last_login->ip_address }}</li>
                                                <li class="">Browser: {{ $last_login->browser }}</li>
                                                <li class="">Operating System: {{ $last_login->operating_system }}
                                                </li>
                                                <li class="mb-0">Device: {{ $last_login->device }}</li>
                                            </ul>

                                        </div>

                                    </div>
                                @endforeach
                            </div>
                            <div class="card card-body">
                                <div class="d-flex justify-content-between align-items-center ">
                                    <p class="m-0 fw-bold ">Remove Account </p>
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-danger btn-md px-5" data-bs-toggle="modal"
                                        data-bs-target="#remove">
                                        Remove
                                    </button>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Button trigger modal -->

    <!-- Modal -->
    <div class="modal fade p-5 m-5" id="remove" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="{{ route('delete.account', $user->id) }}" method="post">
                @csrf
                @method('post')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Delete Account</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <p class="fs-3 fw-bold text-center text-danger ">Are You Sure Delete Account!</p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger">{{ __('web.delete') }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        $('#exampleModal').on('show.bs.modal', event => {
            var button = $(event.relatedTarget);
            var modal = $(this);
            // Use above variables to manipulate the DOM
        });
    </script>
@endsection
@section('js')
    <script>
        var stateId = "{!! $user->state_id !!}";
        var cityId = "{!! $user->city_id !!}";
    </script>
@endsection
