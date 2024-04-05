@extends('frontend.layouts.master')
@section('title', __('web.sub_category'))

@section('content')
    <div class="py-5">
        <div class="container">
            <div class="row">
                @forelse ($category->sub_categories as $sub_category)
                    <div class="col-12 col-lg-4 col-md-6 col-xl-4">
                        <a href="{{ route('products', $sub_category->slug) }}" class="nav-link">
                            <div class="card">
                                <img class="card-img-top" src="{{ asset($sub_category->photo) }}"width="354" height="226"
                                    alt="">
                                <div class="card-body">
                                    <h4 class="">
                                        {{ $sub_category->title }}
                                    </h4>
                                    <p class="m-1">
                                        {{ $sub_category->description }}
                                    </p>
                                </div>
                            </div>
                        </a>
                    </div>
                @empty
                    <p class="text-center">Not Found Category Now Please Try Again!</p>
                @endforelse
            </div>
        </div>
    </div>
@endsection
