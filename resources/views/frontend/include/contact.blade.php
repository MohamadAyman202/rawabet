<section class="contact">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12" data-aos="fade-up">
                <div class="d-flex justify-content-center align-items-center main-head">
                    <h1 class="fs-1 py-3 main-header">{{ __('web.contact') }}</h1>
                </div>
            </div>
            <div class="py-5" data-aos="fade-right" data-aos-offset="300" data-aos-easing="ease-in-sine">
                @include('inc.message')
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('contact') }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="mb-3">
                                        <label for="" class="form-label">{{ __('web.name') }}</label>
                                        <input type="text" name="name" id=""
                                            placeholder="{{ __('web.name') }}"
                                            class="form-control @error('name') is-invalid @enderror" placeholder=""
                                            aria-describedby="helpId" />
                                        @error('name')
                                            <small id="helpId" class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="mb-3">
                                        <label for="" class="form-label">{{ __('web.email') }}</label>
                                        <input type="text" name="email" id=""
                                            placeholder="{{ __('web.email') }}"
                                            class="form-control @error('email') is-invalid @enderror" placeholder=""
                                            aria-describedby="helpId" />
                                        @error('email')
                                            <small id="helpId" class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="mb-3">
                                        <label for="" class="form-label">{{ __('web.phone') }}</label>
                                        <input type="text" name="phone" id=""
                                            placeholder="{{ __('web.phone') }}"
                                            class="form-control @error('phone') is-invalid @enderror" placeholder=""
                                            aria-describedby="helpId" />
                                        @error('phone')
                                            <small id="helpId" class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="mb-3">
                                        <label for="" class="form-label">{{ __('web.subject') }}</label>
                                        <input type="text" name="subject" id=""
                                            placeholder="{{ __('web.subject') }}"
                                            class="form-control @error('subject') is-invalid @enderror" placeholder=""
                                            aria-describedby="helpId" />
                                        @error('subject')
                                            <small id="helpId" class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-md-12 col-lg-12 col-xl-12">
                                    <div class="mb-3">
                                        <label for="" class="form-label">{{ __('web.message') }}</label>
                                        <textarea name="message" class="form-control @error('message') is-invalid @enderror" id="" cols="30"
                                            rows="8" placeholder="{{ __('web.message') }}"></textarea>
                                        @error('message')
                                            <small id="helpId" class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-md-12 col-lg-12 col-xl-12">
                                    <div class="text-center">
                                        <button class="btn btn-primary btn-md px-5"
                                            type="submit">{{ __('web.contact') }}</button>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
