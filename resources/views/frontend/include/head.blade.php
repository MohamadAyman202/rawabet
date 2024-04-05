@php
    $setting = App\Models\Setting::query()->select('favicon')->first();
@endphp
<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>@yield('title')</title>
<link rel="icon" href="{{ URL::asset(asset($setting->favicon)) }}" type="image/x-icon" />
<!-- Fonts -->
<link rel="preconnect" href="https://fonts.bunny.net">
<link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
<!-- Scripts -->
<link rel="stylesheet" href="{{ asset('frontend/assets/css/style.css') }}">
@if (app()->getLocale() == 'en')
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/position-box-slider-ltr.css') }}">
@else
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/position-box-slider-rtl.css') }}">
@endif
<link rel="stylesheet" href="{{ asset('frontend/assets/css/main-title.css') }}">
<link rel="stylesheet" href="{{ asset('frontend/assets/css/loader.css') }}">
@yield('css')

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200..1000&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('frontend/assets/fontawesome/css/all.min.css') }}">
<link href="{{ asset('backend/froala_editor_4.1.4/css/froala_editor.pkgd.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('backend/assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('frontend/assets/bootstrap/dist/css/bootstrap.min.css') }}">
