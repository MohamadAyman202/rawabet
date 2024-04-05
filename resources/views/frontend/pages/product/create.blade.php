@extends('frontend.layouts.master')
@section('css')
    <!--- Select2 css -->
    <link href="{{ URL::asset('backend/assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
@endsection
@section('title')
    {{ __('web.create_products') }}
@endsection

@section('content')
    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        @include('inc.message')
                        <div class="card-body">
                            <form action="{{ route('product_store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-12 col-lg-6 col-md-6 col-xl-6">
                                        <div class="mb-3">
                                            <label for="" class="form-label">{{ __('web.title_cate') }}</label>
                                            <input type="text" name="title" id=""
                                                class="form-control @error('title') is-invalid @enderror"
                                                value="{{ old('title') }}" placeholder="{{ __('web.title_cate') }}"
                                                aria-describedby="helpId" />
                                            @error('title')
                                                <small id="helpId" class="text-muted">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-6 col-md-6 col-xl-6">
                                        <div class="mb-3">
                                            <label for="" class="form-label">{{ __('web.title_cate_en') }}</label>
                                            <input type="text" name="title_en" id=""
                                                value="{{ old('title_en') }}"
                                                class="form-control @error('title_en') is-invalid @enderror"
                                                placeholder="{{ __('web.title_cate_en') }}" aria-describedby="helpId" />
                                            @error('title_en')
                                                <small id="helpId" class="text-muted">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-6 col-md-6 col-xl-6">
                                        <div class="mb-3">
                                            <label for=""
                                                class="form-label">{{ __('web.meta_description_ar') }}</label>
                                            <textarea class="form-control @error('meta_description') is-invalid @enderror" name="meta_description" id=""
                                                placeholder="{{ __('web.meta_description_ar') }}" rows="6">{{ old('meta_description') }}</textarea>
                                            @error('meta_description')
                                                <small id="helpId" class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-6 col-md-6 col-xl-6">
                                        <div class="mb-3">
                                            <label for=""
                                                class="form-label">{{ __('web.meta_description_en') }}</label>

                                            <textarea class="form-control @error('meta_description_en') is-invalid @enderror"
                                                placeholder="{{ __('web.meta_description_en') }}" name="meta_description_en" id="" rows="6">{{ old('meta_description_en') }}</textarea>
                                            @error('meta_description_en')
                                                <small id="helpId" class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-12 col-lg-12 col-md-12 col-xl-12">
                                        <div class="mb-3">
                                            <label for="" class="form-label">{{ __('web.description') }}</label>

                                            <textarea id="editor" class="form-control @error('description') is-invalid @enderror" name="description"
                                                id="" rows="10">{{ old('description') }}</textarea>
                                            @error('description')
                                                <small id="helpId" class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-12 col-lg-12 col-md-12 col-xl-12">
                                        <div class="mb-3">
                                            <label for="" class="form-label">{{ __('web.description_en') }}</label>

                                            <textarea id="editor1" class="form-control @error('description_en') is-invalid @enderror" name="description_en"
                                                id="" rows="10">{{ old('description_en') }}</textarea>
                                            @error('description_en')
                                                <small id="helpId" class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-12 col-md-12 col-xl-12">
                                        <div class="mb-3">
                                            <label for="" class="form-label">{{ __('web.upload_photo') }}</label>
                                            <input type="file" name="photo" id=""
                                                class="form-control @error('photo') is-invalid @enderror"
                                                placeholder="{{ __('web.upload_photo') }}" aria-describedby="helpId" />
                                            @error('photo')
                                                <small id="helpId" class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-12 col-lg-4 col-md-4 col-xl-4">
                                        <div class="mb-3">
                                            <label for="" class="form-label">{{ __('web.price') }}</label>
                                            <input type="text" name="price" id=""
                                                class="form-control @error('price') is-invalid @enderror"
                                                value="{{ old('price') }}" placeholder="{{ __('web.price') }}"
                                                aria-describedby="helpId" />
                                            @error('price')
                                                <small id="helpId" class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-12 col-lg-4 col-md-4 col-xl-4">
                                        <div class="mb-3">
                                            <label for="" class="form-label">{{ __('web.offer') }}</label>
                                            <input type="text" name="offers" id=""
                                                value="{{ old('offers') }}"
                                                class="form-control @error('offers') is-invalid @enderror"
                                                placeholder="{{ __('web.offer') }}" aria-describedby="helpId" />
                                            @error('offers')
                                                <small id="helpId" class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-12 col-lg-4 col-md-4 col-xl-4">
                                        <div class="mb-3">
                                            <label for="" class="form-label">{{ __('web.quantity') }}</label>
                                            <input type="text" name="quantity" id=""
                                                value="{{ old('quantity') }}"
                                                class="form-control @error('quantity') is-invalid @enderror"
                                                placeholder="{{ __('web.quantity') }}" aria-describedby="helpId" />
                                            @error('quantity')
                                                <small id="helpId" class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-4 col-md-4 col-xl-4">
                                        <div class="mb-3">
                                            <label for="" class="form-label">{{ __('web.country') }}</label>
                                            <select class="form-control select2 @error('country_id') is-invalid @enderror"
                                                name="country_id" id="">
                                                <option selected disabled>{{ __('web.country') }}</option>
                                                @isset($data['countries'])
                                                    @foreach ($data['countries'] as $country)
                                                        <option value="{{ $country->id }}">
                                                            {{ $country->emoji }}
                                                            {{ app()->getLocale() == 'en' ? $country->name : $country->native }}
                                                        </option>
                                                    @endforeach
                                                @endisset
                                            </select>
                                            @error('country_id')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-12 col-lg-4 col-md-4 col-xl-4">
                                        <div class="mb-3">
                                            <label for="" class="form-label">{{ __('web.category') }}</label>
                                            <select
                                                class="form-control select2 @error('category_id') is-invalid @enderror"
                                                name="category_id" id="category_id">
                                                <option selected disabled>{{ __('web.category') }}</option>
                                                @isset($data['categories'])
                                                    @foreach ($data['categories'] as $category)
                                                        <option value="{{ $category->id }}">
                                                            {{ $category->title }}
                                                        </option>
                                                    @endforeach
                                                @endisset
                                            </select>
                                            @error('category_id')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-12 col-lg-4 col-md-4 col-xl-4">
                                        <div class="mb-3">
                                            <label for="" class="form-label">{{ __('web.sub_category') }}</label>
                                            <select
                                                class="form-control select2 @error('sub_category_id') is-invalid @enderror"
                                                name="sub_category_id" id="sub_category_id">
                                                <option selected disabled>{{ __('web.sub_category') }}</option>
                                            </select>
                                            @error('sub_category_id')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-6 col-md-6 col-xl-6">
                                        <div class="mb-3">
                                            <label for=""
                                                class="form-label">{{ __('web.measuring_units') }}</label>
                                            <select
                                                class="form-control select2 @error('measuring_unit_id') is-invalid @enderror"
                                                name="measuring_unit_id" id="">
                                                <option selected disabled>{{ __('web.measuring_units') }}</option>
                                                @isset($data['measuring_units'])
                                                    @foreach ($data['measuring_units'] as $measuring_unit)
                                                        <option value="{{ $measuring_unit->id }}">
                                                            {{ $measuring_unit->title }}
                                                        </option>
                                                    @endforeach
                                                @endisset
                                            </select>
                                            @error('measuring_unit_id')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-12 col-lg-6 col-md-6 col-xl-6">
                                        <div class="mb-3">
                                            <label for="" class="form-label">{{ __('web.status') }}</label>
                                            <select class="form-control @error('status') is-invalid @enderror"
                                                name="status" id="">

                                                <option value="active" selected {{ old('active') ? 'selected' : '' }}>
                                                    {{ __('web.active') }}
                                                </option>
                                                <option value="inactive" {{ old('inactive') ? 'selected' : '' }}>
                                                    {{ __('web.inactive') }}</option>
                                            </select>
                                            @error('status')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center mt-3">
                                    <button class="btn btn-primary btn-md" type="submit">{{ __('web.submit') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('js')
    <!-- Internal Select2 js-->
    <script src="{{ URL::asset('backend/assets/plugins/select2/js/select2.min.js') }}"></script>
@endsection
