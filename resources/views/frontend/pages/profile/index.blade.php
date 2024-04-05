@extends('frontend.layouts.master')
@section('title', __('web.profile'))
@section('content')
    <div class="profile-color d-flex justify-content-center align-items-center">
        <img src="{{ asset('assets/images/logo/logo 4 .png') }}" style="height: inherit" alt="" width="400">
        <img class="profile-img" width="100"
            src="{{ $user->photo ? asset($user->photo) : asset('frontend/assets/images/user.png') }}"
            alt="{{ $user->name }}">
    </div>
    <div class="account d-flex align-items-center flex-column  justify-content-center my-5 " dir="ltr">
        <h3 class="m-2 mb-0">
            {{ $user->name }}
            <span class="btn btn-outline-primary fw-bolder btn-sm"
                style="font-size: 10px">{{ ucwords($user->role_name) }}</span>
        </h3>
    </div>
    <section class="pb-5">
        <div class="container">
            <div class="row {{ app()->getLocale() == 'en' ? 'justify-content-end' : 'justify-content-start' }}">
                <div class="col-12 col-lg-5 col-md-12">
                    <div class="card profile-card mb-3">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between">
                                <div class=" mb-1 ">
                                    <h5 class="d-inline">{{ __('web.phone') }}:</h5>
                                    <p class="d-inline">
                                        +{{ $user->country?->phonecode }}{{ $user->phone }}</p>
                                </div>
                                <div class="d-block mb-1 ">
                                    <h5 class="d-inline">{{ __('web.country') }}:</h5>
                                    <p class="d-inline"> {{ $user->country?->name }}
                                        {{ $user->country?->emoji }}</p>
                                </div>
                            </div>
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="d-block mb-1 ">
                                    <h5 class="d-inline">{{ __('web.state') }}:</h5>
                                    <p class="d-inline">
                                        {{ $user->country?->states->where('id', $user->state_id)->first()->name }}
                                    </p>
                                </div>
                                <div class="d-block mb-1 ">
                                    <h5 class="d-inline">{{ __('web.city') }}:</h5>
                                    <p class="d-inline">
                                        {{ $user->country?->cities->where('id', $user->city_id)->first()->name }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card profile-card2 mb-3">
                        <div class="card-body mt-5">
                        </div>
                    </div>
                </div>
                @php
                    $check_subscription = $user->orders()?->latest()->first()?->status_work;
                    $products = $user->products()->get();
                @endphp
                @forelse ($products as $product)
                    <div class="col-12 col-lg-7 col-md-12 mb-3">
                        <a href="{{ route('product_details', $product->slug) }}" class=" nav-link">
                            <div class="card">
                                <img class="card-img-top" src="{{ asset($product->photo) }}"width="354" height="226"
                                    alt="">
                                <div class="card-body">
                                    <h4 class="">
                                        {{ $check_subscription == 'working' || ($product->user->id == $user->id && $check_subscription != 'working') ? $product->title : __('web.title') . ' : ' . __('web.undefined') }}
                                    </h4>
                                    <p class="m-1">
                                        {{ $check_subscription == 'working' || ($product->user->id == $user->id && $check_subscription != 'working') ? $product->meta_description : __('web.meta_description') . ' : ' . __('web.undefined') }}
                                    </p>
                                    <div class="d-flex justify-content-between align-items-center my-2">
                                        <p class="m-0">
                                            <strong>{{ __('web.price') }}: </strong>
                                            {{ $check_subscription == 'working' || ($product->user->id == $user->id && $check_subscription != 'working') ? $product->price : __('web.undefined') }}
                                            {{ $check_subscription == 'working' || ($product->user->id == $user->id && $check_subscription != 'working') ? $product->country->currency_symbol : '' }}
                                        </p>
                                        <p class="m-0">
                                            <strong>{{ __('web.offer') }}: </strong>
                                            {{ $check_subscription == 'working' || ($product->user->id == $user->id && $check_subscription != 'working') ? $product->offers : __('web.undefined') }}
                                            {{ $check_subscription == 'working' || ($product->user->id == $user->id && $check_subscription != 'working') ? $product->country->currency_symbol : '' }}
                                        </p>
                                        <p class="m-0">
                                            <strong>{{ __('web.total') }}: </strong>
                                            @php
                                                $total = $product->price - $product->offers;
                                            @endphp
                                            {{ $check_subscription == 'working' || ($product->user->id == $user->id && $check_subscription != 'working') ? $total : __('web.undefined') }}
                                            {{ $check_subscription == 'working' || ($product->user->id == $user->id && $check_subscription != 'working') ? $product->country->currency_symbol : '' }}
                                        </p>
                                    </div>
                                    <hr>
                                    <div class="account d-flex align-items-center " dir="ltr">
                                        <img src="{{ $product->user->photo ? asset($product->user->photo) : asset('frontend/assets/images/user.png') }}"
                                            width="40" alt="{{ $product->user->name }}">
                                        <h5 class="ms-2 mb-0">
                                            {{ $check_subscription == 'working' || ($product->user->id == $user->id && $check_subscription != 'working') ? $product->user->name : __('web.undefined') }}
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        </a>

                    </div>
                @empty
                    <div class="col-12 col-lg-8 col-md-12">
                        <p class="text-center">Not Found product Now Please Try Again!</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
@endsection
