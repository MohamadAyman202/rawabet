@extends('frontend.layouts.master')
@section('title')
    {{ __('web.subscriptions') }}
@endsection
@section('content')
    <div class="p-5">
        @include('inc.message')
        <section class="subscription">
            <div class="container">
                <div class="row">
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
                                                <form action="{{ route('checkout', $subscription->id) }}" method="get">
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
    </div>
@endsection
