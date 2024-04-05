@php
    $setting = App\Models\Setting::query()->select('logo')->first();
    $check_subscription = $user?->orders()?->latest()->first();
@endphp
<nav class="navbar navbar-expand-lg bg-primary py-3 header" style="height: 85px">
    <div class="container">
        <a class="navbar-brand text-light fw-bold fs-3" href="{{ route('index') }}">
            {{-- {{ config('app.name') }} --}}
            <img src="{{ asset($setting->logo) }}" alt="{{ config('app.name') }}" width="120" style="height: inherit">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link text-light active" aria-current="page"
                        href="{{ route('index') }}">{{ __('web.home') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light" href="#">{{ __('web.about') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light" href="{{ route('categories') }}">{{ __('web.category') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light" href="{{ route('all_products') }}">{{ __('web.products') }}</a>
                </li>


                @auth
                    @php
                        $last_order = auth()->user()->orders()->latest()->first();
                    @endphp
                    @if (is_null($last_order) || (!is_null($last_order) && $last_order?->status_work == 'error'))
                        <li class="nav-item">
                            <a class="nav-link text-light"
                                href="{{ route('subscriptions') }}">{{ __('web.subscriptions') }}</a>
                        </li>
                    @endif
                @endauth
                @guest
                    <li class="nav-item">
                        <a class="nav-link text-light"
                            href="{{ route('subscriptions') }}">{{ __('web.subscriptions') }}</a>
                    </li>
                @endguest

                <li class="nav-item">
                    <a class="nav-link text-light" href="{{ route('contactus') }}">{{ __('web.contact') }}</a>
                </li>
            </ul>
            @auth
                <div class="dropdown {{ app()->getLocale() == 'en' ? 'me-2 ms-1' : 'me-1 ms-2' }} ">
                    <button class="btn border-remove p-0" type="button" id="triggerId" data-bs-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <img width="35" height="35"
                            src="{{ $user->photo ? asset('frontend/assets/images/user.png') : asset('frontend/assets/images/user.png') }}"
                            alt="">
                    </button>
                    <div class="dropdown-menu {{ app()->getLocale() == 'en' ? 'text-start' : 'text-end' }}"
                        aria-labelledby="triggerId">
                        <a class="dropdown-item" href="{{ route('profile') }}">{{ __('web.profile') }}</a>
                        @if ($check_subscription?->end_date >= Date::now() && $check_subscription?->status_work == 'working')
                            <a class="dropdown-item" href="{{ route('my_products') }}">{{ __('web.products') }}</a>
                        @endif
                        <a class="dropdown-item" href="{{ route('invoice') }}">{{ __('web.invoices') }}</a>
                        <a class="dropdown-item" href="{{ route('web.setting') }}">{{ __('web.setting') }}</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#"
                            onclick="event.preventDefault();document.getElementById('form-logout').submit();">{{ __('web.logout') }}</a>
                        <form action="{{ route('logout') }}" method="post" id="form-logout" class="d-none">
                            @csrf
                        </form>
                    </div>
                </div>
            @endauth

            @guest
                <div class="">
                    <a href="{{ route('login') }}"
                        class="btn btn-outline-light {{ app()->getLocale() == 'en' ? 'me-2' : 'ms-2' }}">{{ __('web.login') }}</a>
                    <a href="{{ route('register') }}"
                        class="btn btn-outline-warning {{ app()->getLocale() == 'en' ? 'me-2' : 'ms-2' }}">{{ __('web.register') }}</a>
                </div>

            @endguest
            <div class="dropdown-center">
                <button class="btn btn-light dropdown-toggle {{ app()->getLocale() == 'en' ? 'me-2' : 'ms-2' }}"
                    type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    @if (App::getLocale() == 'ar')
                        {{ LaravelLocalization::getCurrentLocaleName() == 'Arabic' ? 'العربية' : LaravelLocalization::getCurrentLocaleName() }}
                        <img src="{{ URL::asset('assets/images/flags/EG.png') }}" alt="">
                    @else
                        {{ LaravelLocalization::getCurrentLocaleName() }}
                        <img src="{{ URL::asset('assets/images/flags/US.png') }}" alt="">
                    @endif
                </button>
                <ul class="dropdown-menu head-drop">
                    @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                        <li>
                            <a rel="alternate" hreflang="{{ $localeCode }}" class="dropdown-item"
                                href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                {{ $properties['native'] }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</nav>
