@extends('frontend.layouts.master')
@section('title')
    {{ __('web.subscriptions') }}
@endsection
@section('content')
    <div class="p-5">
        @include('inc.message')
        @include('frontend.include.subscription')
    </div>
@endsection
