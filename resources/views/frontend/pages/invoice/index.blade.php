@extends('frontend.layouts.master')
@section('title', __('web.invoices'))
@section('content')
    <section class="py-5">
        <div class="container">
            @forelse ($orders->orders as $order)
                <div class="row justify-content-center">
                    <div class="col-8">
                        <div class="card">
                            <div class="card-body">
                                <div class="order">
                                    <img src="{{ asset($order->subscription->photo) }}" style="height: 300px"
                                        class="w-100 img-fluid" alt="">
                                </div>
                                <div class="row">
                                    <div class="pt-4 pb-2 col-12">
                                        <h5>{{ __('web.title') }}: <span
                                                class="fs-5">{{ $order->subscription->title }}</span>
                                        </h5>
                                    </div>
                                    <div class="col-6 py-1">
                                        <h5>{{ __('web.name') }}: <span class="fs-5">{{ $order->CustomerName }}</span>
                                        </h5>
                                    </div>
                                    <div class="col-6 py-1">
                                        <h5>{{ __('web.email') }}: <span class="fs-5">{{ $order->CustomerEmail }}</span>
                                        </h5>
                                    </div>
                                    <div class="col-6 py-1">
                                        <h5>{{ __('web.phone') }}: <span class="fs-5">{{ $order->CustomerMobile }}</span>
                                        </h5>
                                    </div>
                                    <div class="col-6 py-1">
                                        <h5>{{ __('web.price') }}: <span
                                                class="fs-5">{{ $order->InvoiceDisplayValue }}</span>
                                        </h5>
                                    </div>
                                    <div class="col-6 py-1">
                                        <h5>{{ __('web.purchase') }}: <span
                                                class="fs-5">{{ $order->Fun($order->creatd_at) }}</span>
                                        </h5>
                                    </div>
                                    <div class="col-6 py-1">
                                        <h5>{{ __('web.expiry') }}: <span
                                                class="fs-5">{{ $order->Fun($order->end_date) }}</span>
                                        </h5>
                                    </div>
                                    <div class="col-6 py-1">
                                        <h5>{{ __('web.PaymentGateway') }}: <span
                                                class="fs-5">{{ $order->PaymentGateway }}</span>
                                        </h5>
                                    </div>
                                    <div class="col-6 py-1">
                                        <h5>{{ __('web.CardNumber') }}: <span
                                                class="fs-5">{{ $order->CardNumber }}</span>
                                        </h5>
                                    </div>
                                    <div class="col-6 py-1">
                                        <h5>{{ __('web.expiry') }}: <span class="fs-5">{{ $order->end_date }}</span>
                                        </h5>
                                    </div>
                                    <div class="col-6 py-1">
                                        <h5>{{ __('web.country') }}: <span class="fs-5">{{ $order->Country }}</span>
                                        </h5>
                                    </div>

                                    <div class="col-6 py-1">
                                        <h5>{{ __('web.status') }}: <span
                                                class=" {{ $order->checkColor($order->Error) }}">{{ $order->checkValue($order->Error) }}</span>
                                        </h5>
                                    </div>
                                    <div class="col-6 py-1">
                                        <h5>{{ __('web.work_status') }}: <span
                                                class=" {{ $order->working_status($order->status_work) }}">{{ $order->status_work }}</span>
                                        </h5>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            @empty
            @endforelse
        </div>
    </section>
@endsection
