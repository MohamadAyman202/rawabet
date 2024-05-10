@extends('frontend.layouts.master')
@section('title', __('web.category'))

@section('content')
    <div class="py-5">
        <div class="container">
            <div class="row">
                @forelse ($categories as $category)
                    <div class="col-12 col-lg-4 col-md-6 col-xl-4">
                        <a href="{{ route('sub_categories', $category->slug) }}" class="nav-link">
                            <div class="card mb-4">
                                <img class="card-img-top" src="{{ asset($category->photo) }}"width="354" height="226"
                                    alt="">
                                <div class="card-body">
                                    <h4 class="">
                                        {{ $category->title }}
                                    </h4>
                                    <p class="m-1">
                                        {{ $category->description }}
                                    </p>
                                </div>
                            </div>
                        </a>
                    </div>
                @empty
                    <p class="text-center">Not Found Category Now Please Try Again!</p>
                @endforelse
                <div class="py-3 d-flex justify-content-center align-items-center">
                    {!! $categories->links() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
