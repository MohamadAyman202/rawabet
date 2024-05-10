@extends('frontend.layouts.master')
@section('title', __('web.products'))
@section('content')
    <div class="py-5 sticky">
        <div class="container">
            <div class="row">
                <div class="col-8">
                    <div class="card">
                        <div class="card-body">
                            <img src="{{ asset($product->photo) }}" alt="" class=" text-center" width="822"
                                height="430">
                            <div class="details">
                                <h4 class="mt-3">{{ $product->title }}</h4>
                                <p class="m-0">{!! $product->description !!}</p>
                                <div class="d-flex align-items-center my-2">
                                    <div class="m-0 me-2">
                                        <strong>{{ __('web.category') }}:</strong>
                                        <span class="m-0 ms-1">{{ $product->category->title }}</span>
                                    </div>
                                    <div class="m-0 me-2">
                                        <strong>{{ __('web.sub_category') }}:</strong>
                                        <span class="m-0 ms-1">{{ $product->sub_category?->title }}</span>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center my-2">
                                    <div class="m-0 me-2">
                                        <strong>{{ __('web.quantity') }}: </strong>
                                        {{ $product->quantity }} |
                                    </div>
                                    <div class="m-0 me-2">
                                        <strong>{{ __('web.price') }}: </strong>
                                        <span>
                                            {{ $product->price }}
                                            {{ $product->country->currency_symbol }} |
                                        </span>
                                    </div>
                                    <div class="m-0 me-2">
                                        <strong>{{ __('web.offer') }}: </strong>
                                        <span>
                                            {{ $product->offers }}
                                            {{ $product->country->currency_symbol }} |
                                        </span>
                                    </div>
                                    <div class="m-0">
                                        <strong>{{ __('web.total') }}: </strong>
                                        @php
                                            $total = $product->price - $product->offers;
                                        @endphp
                                        <span>
                                            {{ $total }}
                                            {{ $product->country->currency_symbol }}
                                        </span>
                                    </div>
                                </div>
                                <hr>
                                <div class="account d-flex align-items-center  " dir="ltr">
                                    <img src="{{ $product->user->photo ? asset($product->user->photo) : asset('frontend/assets/images/user.png') }}"
                                        width="40" alt="{{ $product->user->name }}">
                                    <h5 class="ms-2 mb-0">
                                        {{ $product->user->name }}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-4 fixed">
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="account d-flex align-items-center flex-column  justify-content-center mb-2 "
                                dir="ltr">
                                <img src="{{ $product->user->photo ? asset($user->photo) : asset('frontend/assets/images/user.png') }}"
                                    width="40" alt="{{ $product->user->name }}">
                                <h5 class="ms-2 mb-0">
                                    {{ $product->user->name }}
                                    <span class="btn btn-outline-primary fw-bolder btn-sm"
                                        style="font-size: 10px">{{ ucwords($product->user->role_name) }}</span>
                                </h5>
                            </div>
                            <div class="d-flex align-items-center justify-content-between">

                                <div class=" mb-1 ">
                                    <h5 class="d-inline">{{ __('web.phone') }}:</h5>
                                    <p class="d-inline">
                                        +{{ $product->user->country?->phonecode }}{{ $product->user->phone }}</p>
                                </div>
                                <div class="d-block mb-1 ">
                                    <h5 class="d-inline">{{ __('web.country') }}:</h5>
                                    <p class="d-inline"> {{ $product->user->country?->name }}
                                        {{ $product->user->country?->emoji }}</p>
                                </div>
                            </div>
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="d-block mb-1 ">
                                    <h5 class="d-inline">{{ __('web.state') }}:</h5>
                                    <p class="d-inline">
                                        {{ $product->user->country?->states->where('id', $user->state_id)->first()->name }}
                                    </p>
                                </div>
                                <div class="d-block mb-1 ">
                                    <h5 class="d-inline">{{ __('web.city') }}:</h5>
                                    <p class="d-inline">
                                        {{ $product->user->country?->cities->where('id', $user->city_id)->first()->name }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-3">
                        <div class="card-body">
                            <h4>{{ __('web.more_products') }}</h4>
                            <hr>
                            @isset($more_products)
                                @foreach ($more_products as $more_product)
                                    <div class="p-2 product_details">
                                        <a href="{{ route('product_details', $more_product->slug) }}" class="nav-link">
                                            <div class="d-flex align-items-center">
                                                <img src="{{ asset($more_product->photo) }}" width="30"
                                                    alt="{{ $more_product->title }}" class=" img-fluid me-2">
                                                <h5 class="m-0 fw-500">{{ $more_product->title }}</h5>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            @endisset
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
