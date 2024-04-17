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
                @auth
                    <li class="nav-item d-flex justify-content-center align-items-center notifications">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="white"
                            class="bi bi-bell-fill" viewBox="0 0 16 16">
                            <path
                                d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2m.995-14.901a1 1 0 1 0-1.99 0A5 5 0 0 0 3 6c0 1.098-.5 6-2 7h14c-1.5-1-2-5.902-2-7 0-2.42-1.72-4.44-4.005-4.901" />
                        </svg>
                        <span class="bg-danger text-lightrounded-circle notifications-count">0</span>

                        <div class="notifications-body bg-white d-none">
                            <div class="notifications-header bg-secondary ">
                                <h4 class="fw-bold text-light p-2 mb-0">Notifications</h4>
                            </div>
                            <div class="notifications-ele">

                            </div>
                        </div>
                    </li>
                </ul>
            @endauth
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
