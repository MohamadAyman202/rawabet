@extends('frontend.layouts.master')
@section('title', __('web.register'))
@section('content')
    <section class="py-5">
        <div class="container">
            <div class="card">
                <div class="card-body">
                    @include('inc.message')
                    <form action="{{ route('register') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">

                            <div class="col-12 col-lg-6 col-md-6 col-xl-6">
                                <h4>
                                    {{ __('web.register') }} <span
                                        class="text-primary fw-bold ">{{ __('web.customers') }}!</span>
                                </h4>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 col-lg-6 col-md-6 col-xl-6">

                                <div class="">
                                    <label class="form-label">{{ __('web.name') }}</label>
                                    <input class="form-control @error('name') is-invalid @enderror" type="text"
                                        name="name" value="{{ old('name') }}" placeholder="{{ __('web.name') }}" />
                                    @error('name')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-lg-6 col-md-6 col-xl-6">
                                <div class="">
                                    <label class="form-label">{{ __('web.email') }}</label>
                                    <input class="form-control @error('email') is-invalid @enderror" type="email"
                                        autocomplete="email" name="email" value="{{ old('email') }}"
                                        placeholder="{{ __('web.email') }}" />
                                    @error('email')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-lg-6 col-md-6 col-xl-6">
                                <div class="mt-3">
                                    <label class="form-label">{{ __('web.password') }}</label>
                                    <input class="form-control @error('password') is-invalid @enderror" type="password"
                                        name="password" value="{{ old('password') }}"
                                        placeholder="{{ __('web.password') }}" />
                                    @error('password')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12 col-lg-6 col-md-6 col-xl-6">
                                <div class="mt-3">
                                    <label class="form-label">{{ __('web.confirm_password') }}</label>
                                    <input class="form-control @error('confirm_password') is-invalid @enderror"
                                        type="password" name="password_confirmation" value="{{ old('confirm_password') }}"
                                        placeholder="{{ __('web.confirm_password') }}" />
                                    @error('password')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12 col-lg-6 col-md-6 col-xl-6">
                                <div class="mt-3">
                                    <label class="form-label">{{ __('web.phone') }}</label>
                                    <input class="form-control @error('phone') is-invalid @enderror" type="tel"
                                        name="phone" value="{{ old('phone') }}" placeholder="{{ __('web.phone') }}" />
                                    @error('phone')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-lg-6 col-md-6 col-xl-6">
                                <div class="mt-3">
                                    <label for="" class="form-label">{{ __('web.country') }}</label>
                                    <select class="form-control select2 @error('country_id') is-invalid @enderror"
                                        name="country_id">
                                        <option selected disabled>{{ __('web.country') }}</option>
                                        @isset($countries)
                                            @foreach ($countries as $country)
                                                <option value="{{ $country->id }}">
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
                                    <select class="form-control select2 @error('state') is-invalid @enderror"
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
                                    <select class="form-control select2 @error('city_id') is-invalid @enderror"
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
                                    <label for="" class="form-label">{{ __('web.address') }}</label>
                                    <input type="text" placeholder="{{ __('web.address') }}" name="address"
                                        class="form-control @error('address') is-invalid @enderror" placeholder=""
                                        aria-describedby="helpId" />
                                    @error('address')
                                        <small id="helpId" class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="mt-3">
                                    <label for="" class="form-label">{{ __('web.type_account') }}</label>
                                    <select class="form-control select2 @error('type_account') is-invalid @enderror"
                                        name="type_account">
                                        <option selected disabled>{{ __('web.type_account') }}</option>
                                        <option value="imported">imported</option>
                                        <option value="exporter">exporter</option>
                                    </select>
                                    @error('type_account')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="text-center mt-3">
                            <button class="btn ripple btn-primary px-5" type="submit">{{ __('web.submit') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

@endsection
@section('js')
    <script type="text/javascript">
        $(function() {
            proccessData();
            $("select[name='country_id']").on("change", function() {
                proccessData();
            });
        });

        function proccessData() {
            const country_id = $("select[name='country_id']").val();
            const state = $("select[name='state_id']");
            if (country_id) {
                $.ajax({
                    type: "GET",
                    url: `${window.location.origin}/api/state_data/${country_id}`,
                    success: function(response) {
                        state.children().remove();
                        state.append(`
            `);
                        console.log(window.location.origin);
                        $.each(response.data, function(i, ele) {
                            state.append(`
                    <option value="${ele.id}">${ele.name}</option>
                `);
                        });

                        state.on("change", function() {
                            const state_id = $(this).val();
                            const city = $("select[name='city_id']");
                            $.ajax({
                                type: "GET",
                                url: `${window.location.origin}/api/city_data/${country_id}/${state_id}`,
                                success: function(response) {
                                    city.children().remove();
                                    city.append(`
                        `);

                                    $.each(response.data, function(i, ele) {
                                        city.append(`
                                <option value="${ele.id}">${ele.name}</option>
                            `);
                                    });
                                },
                            });
                        });
                    },
                });
            }
        }
    </script>
@endsection
