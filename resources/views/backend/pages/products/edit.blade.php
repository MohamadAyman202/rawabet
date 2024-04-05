@extends('backend.layouts.master')
@section('css')
    <!--- Select2 css -->
    <link href="{{ URL::asset('backend/assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
@endsection
@section('title')
    {{ __('web.edit_products') }}
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">Tables</h4><span class="text-muted mt-1 tx-13 ml-2 mb-0">/ Data
                    Tables</span>
            </div>
        </div>
        <div class="d-flex my-xl-auto right-content">
            <div class="pr-1 mb-3 mb-xl-0">
                <button type="button" class="btn btn-info btn-icon mr-2"><i class="mdi mdi-filter-variant"></i></button>
            </div>
            <div class="pr-1 mb-3 mb-xl-0">
                <button type="button" class="btn btn-danger btn-icon mr-2"><i class="mdi mdi-star"></i></button>
            </div>
            <div class="pr-1 mb-3 mb-xl-0">
                <button type="button" class="btn btn-warning  btn-icon mr-2"><i class="mdi mdi-refresh"></i></button>
            </div>
            <div class="mb-3 mb-xl-0">
                <div class="btn-group dropdown">
                    <button type="button" class="btn btn-primary">14 Aug 2019</button>
                    <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split"
                        id="dropdownMenuDate" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuDate"
                        data-x-placement="bottom-end">
                        <a class="dropdown-item" href="#">2015</a>
                        <a class="dropdown-item" href="#">2016</a>
                        <a class="dropdown-item" href="#">2017</a>
                        <a class="dropdown-item" href="#">2018</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                @include('inc.message')
                <div class="card-body">
                    <form action="{{ route('admin.products.update', $data['product']->slug) }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="row">
                            <div class="col-12 col-lg-6 col-md-6 col-xl-6">
                                <div class="mb-3">
                                    <label for="" class="form-label">{{ __('web.title_cate') }}</label>
                                    <input type="text" name="title" id=""
                                        class="form-control @error('title') is-invalid @enderror"
                                        value="{{ $data['product']->getTranslation('title', 'ar') }}"
                                        placeholder="{{ __('web.title_cate') }}" aria-describedby="helpId" />
                                    @error('title')
                                        <small id="helpId" class="text-muted">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-lg-6 col-md-6 col-xl-6">
                                <div class="mb-3">
                                    <label for="" class="form-label">{{ __('web.title_cate_en') }}</label>
                                    <input type="text" name="title_en" id=""
                                        value="{{ $data['product']->getTranslation('title', 'en') }}"
                                        class="form-control @error('title_en') is-invalid @enderror"
                                        placeholder="{{ __('web.title_cate_en') }}" aria-describedby="helpId" />
                                    @error('title_en')
                                        <small id="helpId" class="text-muted">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-lg-6 col-md-6 col-xl-6">
                                <div class="mb-3">
                                    <label for="" class="form-label">{{ __('web.meta_description_ar') }}</label>
                                    <textarea class="form-control @error('meta_description') is-invalid @enderror" name="meta_description" id=""
                                        placeholder="{{ __('web.meta_description_ar') }}" rows="6">{{ $data['product']->getTranslation('meta_description', 'ar') }}</textarea>
                                    @error('meta_description')
                                        <small id="helpId" class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-lg-6 col-md-6 col-xl-6">
                                <div class="mb-3">
                                    <label for="" class="form-label">{{ __('web.meta_description_en') }}</label>
                                    <textarea class="form-control @error('meta_description_en') is-invalid @enderror"
                                        placeholder="{{ __('web.meta_description_en') }}" name="meta_description_en" id="" rows="6">{{ $data['product']->getTranslation('meta_description', 'en') }}</textarea>
                                    @error('meta_description_en')
                                        <small id="helpId" class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12 col-lg-12 col-md-12 col-xl-12">
                                <div class="mb-3">

                                    <label for="" class="form-label">{{ __('web.description') }}</label>
                                    <textarea class="form-control @error('description') is-invalid @enderror" placeholder="{{ __('web.description') }}"
                                        name="description" id="editor" rows="10">{{ $data['product']->getTranslation('description', 'ar') }}</textarea>
                                    @error('description')
                                        <small id="helpId" class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12 col-lg-12 col-md-12 col-xl-12">
                                <div class="mb-3">
                                    <label for="" class="form-label">{{ __('web.description_en') }}</label>

                                    <textarea class="form-control @error('description_en') is-invalid @enderror"
                                        placeholder="{{ __('web.description_en') }}" name="description_en" id="editor1" rows="10">{{ $data['product']->getTranslation('description', 'en') }}</textarea>
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
                                        value="{{ $data['product']->price }}" placeholder="{{ __('web.price') }}"
                                        aria-describedby="helpId" />
                                    @error('price')
                                        <small id="helpId" class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12 col-lg-4 col-md-4 col-xl-4">
                                <div class="mb-3">
                                    <label for="" class="form-label">{{ __('web.offer') }}</label>
                                    <input type="text" name="offers" id="" value="{{ $data['product']->offers }}"
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
                                    <input type="text" name="quantity" id="" value="{{ $data['product']->quantity }}"
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
                                                <option value="{{ $country->id }}"
                                                    {{ $country->id == $data['product']->country_id ? 'selected' : '' }}>
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
                                    <select class="form-control select2 @error('category_id') is-invalid @enderror"
                                        name="category_id" id="category_id">
                                        <option selected disabled>{{ __('web.category') }}</option>
                                        @isset($data['categories'])
                                            @foreach ($data['categories'] as $category)
                                                <option value="{{ $category->id }}"
                                                    {{ $category->id == $data['product']->category_id ? 'selected' : '' }}>
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
                                    <select class="form-control select2 @error('sub_category_id') is-invalid @enderror"
                                        name="sub_category_id" id="sub_category_id">
                                        <option selected disabled>{{ __('web.sub_category') }}</option>
                                    </select>
                                    @error('sub_category_id')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-lg-4 col-md-4 col-xl-4">
                                <div class="mb-3">
                                    <label for="" class="form-label">{{ __('web.measuring_units') }}</label>
                                    <select class="form-control select2 @error('measuring_unit_id') is-invalid @enderror"
                                        name="measuring_unit_id" id="">
                                        <option selected disabled>{{ __('web.measuring_units') }}</option>
                                        @isset($data['measuring_units'])
                                            @foreach ($data['measuring_units'] as $measuring_unit)
                                                <option value="{{ $measuring_unit->id }}"
                                                    {{ $measuring_unit->id == $data['product']->measuring_unit_id ? 'selected' : '' }}>
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

                            <div class="col-12 col-lg-4 col-md-4 col-xl-4">
                                <div class="mb-3">
                                    <label for="" class="form-label">{{ __('web.importers') }}</label>
                                    <select class="form-control select2 @error('user_id') is-invalid @enderror"
                                        name="user_id" id="">
                                        <option selected disabled>{{ __('web.importers') }}</option>
                                        @isset($data['users'])
                                            @foreach ($data['users'] as $user)
                                                <option value="{{ $user->id }}"
                                                    {{ $user->id == $data['product']->user_id ? 'selected' : '' }}>
                                                    {{ $user->email }}
                                                </option>
                                            @endforeach
                                        @endisset
                                    </select>
                                    @error('user_id')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12 col-lg-4 col-md-4 col-xl-4">
                                <div class="mb-3">
                                    <label for="" class="form-label">{{ __('web.status') }}</label>
                                    <select class="form-control @error('status') is-invalid @enderror" name="status"
                                        id="">
                                        <option selected disabled>{{ __('web.status') }}</option>
                                        <option value="active" {{ $data['product']->status == 'active' ? 'selected' : '' }}>
                                            {{ __('web.active') }}
                                        </option>
                                        <option value="inactive" {{ $data['product']->status == 'inactive' ? 'selected' : '' }}>
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
@endsection
@section('js')
    <!-- Internal Select2 js-->
    <script src="{{ URL::asset('backend/assets/plugins/select2/js/select2.min.js') }}"></script>
@endsection
