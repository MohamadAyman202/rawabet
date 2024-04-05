@extends('frontend.layouts.master')
@section('title', __('web.products'))
@section('content')
    <div class="py-5">
        @php
            $check_subscription = $user->orders()?->latest()->first()?->status_work;
        @endphp
        <div class="container">
            <div class="row">
                @forelse ($data['products'] as $product)
                    <div class="col-12 col-lg-4 col-md-6 col-xl-4 mb-3">
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
                    <p class="text-center">Not Found product Now Please Try Again!</p>
                @endforelse

            </div>
        </div>
    </div>
@endsection
