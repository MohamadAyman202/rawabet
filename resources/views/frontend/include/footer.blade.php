@php
    $setting = App\Models\Setting::first();
@endphp
<section class="footer p-5">
    <div class="container">
        <div class="row">
            <div class="col-12  col-lg-6 col-md-6 col-xl-6" style="height: 85px">
                <img src="{{ asset($setting->logo) }}" alt="{{ config('app.name') }}" width="200" style="height: inherit"
                    class="p-2">
            </div>
            <div class="col-12 col-lg-6 col-md-6 col-xl-6 text-center">
                <a href="{{ $setting->facebook }}" target="_blank"
                    class="{{ app()->getLocale() == 'en' ? 'me-2' : 'ms-2' }}">
                    <img class="p-2 bg-white rounded-circle"
                        src="{{ asset('assets/logo-links/Facebook_Logo_2023.png') }}" width="50" alt="">
                </a>

                <a href="{{ $setting->instagram }}" target="_blank"
                    class="{{ app()->getLocale() == 'en' ? 'me-2' : 'ms-2' }}">
                    <img class="p-2 bg-white rounded-circle"
                        src="{{ asset('assets/logo-links/Instagram_icon.png.webp') }}" width="50" alt="">
                </a>

                <a href="{{ $setting->facebook }}" target="_blank"
                    class="{{ app()->getLocale() == 'en' ? 'me-2' : 'ms-2' }}">
                    <img class="p-2 bg-white rounded-circle"
                        src="{{ asset('assets/logo-links/free-twitter-logo-icon-2429-thumb.png') }}" width="50"
                        alt="">
                </a>
            </div>
            <div class="col-12 mt-2">
                <p class="text-light fs-3 m-0 p-0">&copy; {{ config('app.name') }} 2024 {{ __('web.reserved') }}</p>
            </div>

        </div>
    </div>
</section>
