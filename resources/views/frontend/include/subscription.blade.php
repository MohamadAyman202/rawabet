<section class="subscription">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12">
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
                                    @auth

                                        <div class="text-center">
                                            <form action="{{ route('pay') }}" method="POST">
                                                @csrf
                                                <input type="hidden" id="pay_subscription" name="pay_subscription"
                                                    value="{{ $subscription }}">
                                                <input type="hidden" id="user" name="user"
                                                    value="{{ auth()->user() }}">
                                                <button id="pay_route"
                                                    class="btn btn-primary btn-block w-100 fs-5">{{ __('web.subscription') }}</button>
                                            </form>
                                        </div>
                                    @endauth
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
