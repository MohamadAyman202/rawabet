@extends('frontend.layouts.master')
@section('title')
    {{ __('web.home') }}
@endsection
@section('css')
    <link rel="stylesheet" href="{{ URL::asset('frontend/assets/css/style.css') }}">
@endsection
@section('content')
    @php
        $position_one = app()->getLocale() == 'en' ? 'fade-left' : 'fade-right';
        $position_two = app()->getLocale() == 'en' ? 'fade-right' : 'fade-left';
    @endphp
    <!-- Start Slider -->
    <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner my-slider">
            @forelse ($data['slider'] as $key => $slider)
                <div class="carousel-item position-relative {{ $key == 0 ? 'active' : '' }} slider-img">
                    <img src="{{ asset($slider->photo) }}" class="d-block slider-img w-100" alt="{{ $slider->title }}">
                    <div class="box-slider p-5">
                        <h2 class="text-light">{{ $slider->title }}</h2>
                        <p class="text-light fs-5">
                            {{ $slider->description }}
                        </p>
                    </div>
                </div>
            @empty
                <div class="carousel-item position-relative slider-img">
                    <img src="data:image/jpeg;base64,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"
                        class="d-block slider-img w-100" alt="...">
                    <div class="box-slider p-5">
                        <h2 class="text-light">welcome</h2>
                        <p class="text-light fs-5">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Assumenda vel odit architecto nulla
                            provident
                            eius inventore animi excepturi aperiam cumque blanditiis eum ea, nesciunt minus, amet soluta,
                            repellendus quisquam beatae!
                        </p>
                    </div>
                </div>
            @endforelse
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <!-- End Slider -->
    <!-- Start About us -->
    <section class="my-5">
        <div class="container">

            <div class="row">

                <div class="col-lg-12 col-md-12" data-aos="fade-left">
                    <div class="d-flex justify-content-center align-items-center main-head">
                        <h1 class="fs-1 py-3 main-header">{{ __('web.about') }}</h1>
                    </div>
                </div>
                <div class="py-5">
                    <div class="row">
                        <div class="col-12 col-lg-6 col-md-6 col-xl-6" data-aos="{{ $position_two }}" data-aos-offset="300"
                            data-aos-easing="ease-in-sine">
                            <h2 class="fs-1">{{ __('web.welcome') }}</h2>
                            <p class="fs-4">{{ __('web.company') }}</p>
                            <p class="fs-4">{{ __('web.versa') }}</p>
                        </div>
                        <div class="col-12 col-lg-6 col-md-6 col-xl-6" data-aos="{{ $position_one }}" data-aos-offset="300"
                            data-aos-easing="ease-in-sine">
                            <div class="main-img">
                                <img class="w-100 " src="{{ asset('assets/images/86528626.cms') }}" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <!-- End About us -->
    <!-- Start Services -->
    <section class="support">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12" data-aos="fade-right">
                    <div class="d-flex justify-content-center align-items-center main-head">
                        <h1 class="fs-1 py-3 main-header">{{ __('web.services') }}</h1>
                    </div>
                </div>
                <div class="py-5">
                    <div class="row">

                        <div class="col-12 col-lg-4 col-md-6 col-xl-4" data-aos="{{ $position_two }}" data-aos-offset="300"
                            data-aos-easing="ease-in-sine">
                            <div class="card">
                                <img class="card-img-top"
                                    src="{{ asset('assets/images/istockphoto-1304746031-612x612.jpg') }}"width="354"
                                    height="226" alt="">
                                <div class="card-body">
                                    <h5 class="card-title fw-bold">{{ __('web.importers') }}</h5>
                                    <p class="card-text fs-5">
                                        {{ __('web.importer_service') }}
                                    </p>
                                </div>

                            </div>
                        </div>
                        <div class="col-12 col-lg-4 col-md-6 col-xl-4" data-aos="fade-up" data-aos-offset="300"
                            data-aos-easing="ease-in-sine">
                            <div class="card">
                                <img class="card-img-top" src="{{ asset('assets/images/export-credit-sheet.jpg') }}"
                                    width="354" height="226" alt="">
                                <div class="card-body">
                                    <h5 class="card-title fw-bold">{{ __('web.exporters') }}</h5>
                                    <p class="card-text fs-5">
                                        {{ __('web.exporter_service') }}
                                    </p>
                                </div>

                            </div>
                        </div>
                        <div class="col-12 col-lg-4 col-md-6 col-xl-4" data-aos="{{ $position_one }}" data-aos-offset="300"
                            data-aos-easing="ease-in-sine">
                            <div class="card">
                                <img class="card-img-top" src="{{ asset('assets/images/support.jpg') }}" width="354"
                                    height="226" alt="">
                                <div class="card-body">
                                    <h5 class="card-title fw-bold">{{ __('web.support') }}</h5>
                                    <p class="card-text fs-5">
                                        {{ __('web.support_service') }}
                                    </p>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!-- End Services -->
    <!-- Start Subscription -->
    <section class="subscription">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12" data-aos="fade-down">
                    <div class="d-flex justify-content-center align-items-center main-head">
                        <h1 class="fs-1 py-3 main-header">{{ __('web.subscriptions') }}</h1>
                    </div>
                </div>
                <div class="py-5">
                    <div class="row">
                        @forelse ($data['subscription'] as $subscription)
                            <div class="col-12 col-lg-4 col-md-6 col-xl-4">
                                <div class="card">
                                    <img class="card-img-top" src="{{ asset($subscription->photo) }}"width="354"
                                        height="226" alt="">
                                    <div class="card-body">
                                        <div class="p-3">
                                            {!! $subscription->description !!}
                                        </div>

                                        <div class="text-center">
                                            <form action="{{ route('checkout', $subscription->all()) }}" method="get">
                                                @csrf
                                                <button type="submit"
                                                    class="btn btn-primary btn-md w-100 btn-block fs-5">{{ __('web.subscription') }}</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p class="text-center">Not Found Subscription Now Please Try Again!</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- End Subscription -->
    <!-- Start Contact Us -->
    @include('frontend.include.contact')
    <!-- End Contact Us -->
@endsection
