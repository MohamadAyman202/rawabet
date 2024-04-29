@extends('frontend.layouts.master')
@section('title', __('web.checkout'))
@section('content')
    <section class="checkout">
        <div class="container">
            <form action="{{ route('pay') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-lg-8 col-md-8">
                        <div class="card">
                            <div class="card-body">
                                @include('inc.message')
                                <div class="row">
                                    <input type="hidden" name="customer" value="{{ $user->id }}" id="">
                                    <input type="hidden" name="subscription" value="{{ $subscription->id }}"
                                        id="">
                                    <input type="hidden" name="price" value="{{ $subscription->price }}" id="">
                                    <div class="col-12 ">
                                        <div class="mb-3">
                                            <label for="" class="form-label">{{ __('web.name') }}</label>
                                            <input type="text" name="name" value="{{ $user->name }}" id=""
                                                class="form-control @error('name') is-invalid @enderror"
                                                placeholder="{{ __('web.name') }}" aria-describedby="helpId" />
                                            @error('name')
                                                <small id="helpId" class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-12 ">
                                        <div class="mb-3">
                                            <label for="" class="form-label">{{ __('web.email') }}</label>
                                            <input type="text" name="email" value="{{ $user->email }}" id=""
                                                class="form-control @error('email') is-invalid @enderror"
                                                placeholder="{{ __('web.email') }}" aria-describedby="helpId" />
                                            @error('email')
                                                <small id="helpId" class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-12 ">
                                        <div class="mb-3">
                                            <label for="" class="form-label">{{ __('web.address') }}</label>
                                            <input type="text" name="name" value="{{ $user->address }}"
                                                id="" class="form-control @error('address') is-invalid @enderror"
                                                placeholder="{{ __('web.address') }}" aria-describedby="helpId" />
                                            @error('address')
                                                <small id="helpId" class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-12 ">
                                        <div class="mb-3">
                                            <label for="" class="form-label">{{ __('web.phone') }}</label>
                                            <input type="tel" readonly name="phone" value="{{ $user->phone }}"
                                                id="" class="form-control @error('phone') is-invalid @enderror"
                                                placeholder="{{ __('web.phone') }}" aria-describedby="helpId" />
                                            @error('phone')
                                                <small id="helpId" class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <img src="{{ asset($subscription->photo) }}" class="img-fluid mb-2" alt="">
                                <h4 class="mb-1">{{ $subscription->title }}</h4>
                                <p class="fw-bold fs-6 mb-0">{{ $subscription->price }}
                                    {{ $subscription->country->currency_symbol ?? 'EG' }}</p>
                                <input type="hidden" id="pay_subscription" name="pay_subscription"
                                    value="{{ $subscription }}">
                                <input type="hidden" id="user" name="user" value="{{ auth()->user() }}">
                                <button id="pay_route"
                                    class="btn btn-primary btn-block w-100 fs-5">{{ __('web.checkout') }}</button>

                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

    </section>
@endsection
