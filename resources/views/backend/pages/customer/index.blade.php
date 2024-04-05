@extends('backend.layouts.master')
@section('css')
    <!-- Internal Data table css -->
    <link href="{{ URL::asset('backend/assets/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('backend/assets/plugins/datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('backend/assets/plugins/datatable/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('backend/assets/plugins/datatable/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('backend/assets/plugins/datatable/css/responsive.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('backend/assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
    <!---Internal Owl Carousel css-->
    <link href="{{ URL::asset('backend/assets/plugins/owl-carousel/owl.carousel.css') }}" rel="stylesheet">
    <!---Internal  Multislider css-->
    <link href="{{ URL::asset('backend/assets/plugins/multislider/multislider.css') }}" rel="stylesheet">
    <!--- Select2 css -->
@endsection

@section('title')
    {{ __('web.customers') }}
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
    <!-- row opened -->
    <div class="row row-sm">

        <!--div-->
        <div class="col-xl-12">
            <div class="card mg-b-20">
                <div class="card-header pb-0">
                    @include('inc.message')
                    <a class="modal-effect btn btn-primary btn-md" data-toggle="modal"
                        href="#modaldemo8">{{ __('web.create_customer') }}</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table key-buttons text-md-nowrap">
                            <thead>
                                <tr>
                                    <th class="border-bottom-0">#</th>
                                    <th class="border-bottom-0">{{ __('web.name') }}</th>
                                    <th class="border-bottom-0">{{ __('web.email') }}</th>
                                    <th class="border-bottom-0">{{ __('web.phone') }}</th>
                                    <th class="border-bottom-0">{{ __('web.type_account') }}</th>
                                    <th class="border-bottom-0">{{ __('web.country') }}</th>
                                    <th class="border-bottom-0">{{ __('web.state') }}</th>
                                    <th class="border-bottom-0">{{ __('web.city') }}</th>
                                    <th class="border-bottom-0">{{ __('web.status') }}</th>
                                    <th class="border-bottom-0">{{ __('web.created_at') }}</th>
                                    <th class="border-bottom-0">{{ __('web.updated_at') }}</th>
                                    <th class="border-bottom-0">{{ __('web.actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @isset($customers)
                                    @foreach ($customers as $customer)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $customer->name }}</td>
                                            <td>{{ $customer->email }}</td>
                                            <td>{{ $customer->phone }}</td>
                                            <td>{{ $customer->role_name }}</td>
                                            <td>{{ $customer->country?->emoji }} {{ $customer->country?->name }}</td>
                                            <td>{{ $customer->country?->states->where('id', $customer->state_id)->first()?->name }}
                                            </td>
                                            <td>{{ $customer->country?->states->where('id', $customer->state_id)->first()?->cities->where('id', $customer->city_id)->first()?->name }}
                                            </td>
                                            <td>
                                                <span class="{{ $customer->Status($customer->status) }}">
                                                    {{ ucwords($customer->status) }}
                                                </span>
                                            <td>
                                                {{ $customer->Fun($customer->created_at) }}
                                            </td>
                                            <td>
                                                {{ $customer->Fun($customer->updated_at) }}
                                            </td>
                                            <td>
                                                <a class="modal-effect btn btn-primary btn-sm" data-toggle="modal"
                                                    href="#edit{{ $customer->id }}">{{ __('web.edit') }}</a>

                                                <a class="modal-effect btn btn-danger btn-sm" data-toggle="modal"
                                                    href="#delete{{ $customer->id }}">{{ __('web.delete') }}</a>
                                            </td>
                                        </tr>

                                        <!-- Modal Edit Customer -->
                                        <div class="modal" id="edit{{ $customer->id }}">
                                            <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
                                                <div class="modal-content modal-content-demo">
                                                    <div class="modal-header">
                                                        <h6 class="modal-title">{{ __('web.edit_customer') }}</h6><button
                                                            aria-label="Close" class="close" data-dismiss="modal"
                                                            type="button"><span aria-hidden="true">&times;</span></button>
                                                    </div>
                                                    <form action="{{ route('admin.customers.update', $customer->id) }}"
                                                        method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('PATCH')
                                                        <div class="modal-body">

                                                            <div class="row">
                                                                <div class="col-12 col-lg-6 col-md-6 col-xl-6">

                                                                    <div class="">
                                                                        <label class="form-label">{{ __('web.name') }}</label>
                                                                        <input
                                                                            class="form-control @error('name') is-invalid @enderror"
                                                                            type="text" name="name"
                                                                            value="{{ $customer->name }}"
                                                                            placeholder="{{ __('web.name') }}" />
                                                                        @error('name')
                                                                            <small class="text-danger">{{ $message }}</small>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                                <div class="col-12 col-lg-6 col-md-6 col-xl-6">
                                                                    <div class="">
                                                                        <label
                                                                            class="form-label">{{ __('web.email') }}</label>
                                                                        <input
                                                                            class="form-control @error('email') is-invalid @enderror"
                                                                            type="email" autocomplete="email"
                                                                            name="email" value="{{ $customer->email }}"
                                                                            placeholder="{{ __('web.email') }}" />
                                                                        @error('email')
                                                                            <small class="text-danger">{{ $message }}</small>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                                <div class="col-12 col-lg-6 col-md-6 col-xl-6">
                                                                    <div class="mt-3">
                                                                        <label
                                                                            class="form-label">{{ __('web.password') }}</label>
                                                                        <input
                                                                            class="form-control @error('password') is-invalid @enderror"
                                                                            type="password" autocomplete="new-password"
                                                                            name="password"
                                                                            placeholder="{{ __('web.password') }}" />
                                                                        @error('password')
                                                                            <small class="text-danger">{{ $message }}</small>
                                                                        @enderror
                                                                    </div>
                                                                </div>

                                                                <div class="col-12 col-lg-6 col-md-6 col-xl-6">
                                                                    <div class="mt-3">
                                                                        <label
                                                                            class="form-label">{{ __('web.confirm_password') }}</label>
                                                                        <input
                                                                            class="form-control @error('confirm_password') is-invalid @enderror"
                                                                            autocomplete="new-password" type="password"
                                                                            name="confirm_password"
                                                                            placeholder="{{ __('web.confirm_password') }}" />
                                                                        @error('password')
                                                                            <small class="text-danger">{{ $message }}</small>
                                                                        @enderror
                                                                    </div>
                                                                </div>

                                                                <div class="col-12 col-lg-6 col-md-6 col-xl-6">
                                                                    <div class="mt-3">
                                                                        <label
                                                                            class="form-label">{{ __('web.phone') }}</label>
                                                                        <input
                                                                            class="form-control @error('phone') is-invalid @enderror"
                                                                            type="tel" name="phone"
                                                                            value="{{ $customer->phone }}"
                                                                            placeholder="{{ __('web.phone') }}" />
                                                                        @error('phone')
                                                                            <small class="text-danger">{{ $message }}</small>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                                <div class="col-12 col-lg-6 col-md-6 col-xl-6">
                                                                    <div class="mt-3">
                                                                        <label for=""
                                                                            class="form-label">{{ __('web.country') }}</label>
                                                                        <select
                                                                            class="form-control select2 @error('country_id') is-invalid @enderror"
                                                                            name="country_id">
                                                                            <option selected disabled>{{ __('web.country') }}
                                                                            </option>
                                                                            @isset($countries)
                                                                                @foreach ($countries as $country)
                                                                                    <option value="{{ $country->id }}"
                                                                                        {{ $country->id == $customer->country_id ? 'selected' : '' }}>
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

                                                                <div class="col-12 col-lg-6 col-md-6 col-xl-6">
                                                                    <div class="mt-3">
                                                                        <label for=""
                                                                            class="form-label">{{ __('web.state') }}</label>
                                                                        <select
                                                                            class="form-control select2 @error('state') is-invalid @enderror"
                                                                            name="state_id">
                                                                            <option selected disabled>{{ __('web.state') }}
                                                                            </option>
                                                                        </select>
                                                                        @error('state_id')
                                                                            <small class="text-danger">{{ $message }}</small>
                                                                        @enderror
                                                                    </div>
                                                                </div>

                                                                <div class="col-12 col-lg-6 col-md-6 col-xl-6">
                                                                    <div class="mt-3">
                                                                        <label for=""
                                                                            class="form-label">{{ __('web.city') }}</label>
                                                                        <select
                                                                            class="form-control select2 @error('city_id') is-invalid @enderror"
                                                                            name="city_id">
                                                                            <option selected disabled>{{ __('web.city') }}
                                                                            </option>
                                                                        </select>
                                                                        @error('city_id')
                                                                            <small class="text-danger">{{ $message }}</small>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                                <div class="col-12 col-lg-12 col-md-12 col-xl-12">
                                                                    <div class="mt-3">
                                                                        <label for=""
                                                                            class="form-label">{{ __('web.address') }}</label>
                                                                        <input type="text"
                                                                            placeholder="{{ __('web.address') }}"
                                                                            name="address" value="{{ $customer->address }}"
                                                                            class="form-control @error('address') is-invalid @enderror"
                                                                            placeholder="" aria-describedby="helpId" />
                                                                        @error('address')
                                                                            <small id="helpId"
                                                                                class="text-danger">{{ $message }}</small>
                                                                        @enderror
                                                                    </div>

                                                                </div>

                                                                <div class="col-12 col-lg-6 col-md-6 col-xl-6">
                                                                    <div class="mt-3">
                                                                        <label for=""
                                                                            class="form-label">{{ __('web.type_account') }}</label>
                                                                        <select
                                                                            class="form-control select2 @error('type_account') is-invalid @enderror"
                                                                            name="type_account">
                                                                            <option selected disabled>
                                                                                {{ __('web.type_account') }}</option>
                                                                            <option value="imported"
                                                                                {{ $customer->role_name == 'imported' ? 'selected' : '' }}>
                                                                                imported</option>
                                                                            <option value="exporter"
                                                                                {{ $customer->role_name == 'exporter' ? 'selected' : '' }}>
                                                                                exporter</option>
                                                                        </select>
                                                                        @error('type_account')
                                                                            <small class="text-danger">{{ $message }}</small>
                                                                        @enderror
                                                                    </div>
                                                                </div>

                                                                <div class="col-12 col-lg-6 col-md-6 col-xl-6">
                                                                    <div class="mt-3">
                                                                        <label for=""
                                                                            class="form-label">{{ __('web.status') }}</label>
                                                                        <select
                                                                            class="form-control select2 @error('status') is-invalid @enderror"
                                                                            name="status">
                                                                            <option selected disabled>{{ __('web.status') }}
                                                                            </option>
                                                                            <option value="active"
                                                                                {{ $customer->status == 'active' ? 'selected' : '' }}>
                                                                                active</option>
                                                                            <option value="inactive"
                                                                                {{ $customer->status == 'inactive' ? 'selected' : '' }}>
                                                                                inactive</option>
                                                                        </select>
                                                                        @error('status')
                                                                            <small class="text-danger">{{ $message }}</small>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button class="btn ripple btn-primary"
                                                                type="submit">{{ __('web.submit') }}</button>
                                                            <button class="btn ripple btn-secondary" data-dismiss="modal"
                                                                type="button">{{ __('web.close') }}</button>
                                                        </div>
                                                    </form>

                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Modal Edit Customer-->

                                        <!-- Modal Delete Category -->
                                        <div class="modal" id="delete{{ $customer->id }}">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content modal-content-demo">
                                                    <div class="modal-header">
                                                        <h6 class="modal-title">{{ __('web.delete_customer') }}</h6>
                                                        <button aria-label="Close" class="close" data-dismiss="modal"
                                                            type="button"><span aria-hidden="true">&times;</span></button>
                                                    </div>
                                                    <form action="{{ route('admin.customers.destroy', $customer->id) }}"
                                                        method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('delete')
                                                        <div class="modal-body">

                                                            <div class="text-center">
                                                                <p class="text-danger" style="font-size: 30px">
                                                                    {{ __('web.message_delete') }}</p>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button class="btn ripple btn-danger"
                                                                type="submit">{{ __('web.delete') }}</button>
                                                            <button class="btn ripple btn-secondary" data-dismiss="modal"
                                                                type="button">{{ __('web.close') }}</button>
                                                        </div>
                                                    </form>

                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Modal Delete Category-->
                                    @endforeach
                                @endisset
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-center mt-3">
                            {!! $customers->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/div-->


    </div>
    <!-- /row -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->

    <!-- Modal Created Customer -->
    <div class="modal" id="modaldemo8">
        <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">{{ __('web.create_customer') }}</h6><button aria-label="Close"
                        class="close" data-dismiss="modal" type="button"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <form action="{{ route('admin.customers.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">

                        <div class="row">
                            <div class="col-12 col-lg-6 col-md-6 col-xl-6">

                                <div class="">
                                    <label class="form-label">{{ __('web.name') }}</label>
                                    <input class="form-control @error('name') is-invalid @enderror" type="text"
                                        name="name" value="{{ old('name') }}"
                                        placeholder="{{ __('web.name') }}" />
                                    @error('name')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-lg-6 col-md-6 col-xl-6">
                                <div class="">
                                    <label class="form-label">{{ __('web.email') }}</label>
                                    <input class="form-control @error('email') is-invalid @enderror" type="email"
                                        autocomplete="email" name="email" value="{{ old('email') }}"
                                        placeholder="{{ __('web.email') }}" />
                                    @error('email')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-lg-6 col-md-6 col-xl-6">
                                <div class="mt-3">
                                    <label class="form-label">{{ __('web.password') }}</label>
                                    <input class="form-control @error('password') is-invalid @enderror" type="password"
                                        autocomplete="new-password" name="password" value="{{ old('password') }}"
                                        placeholder="{{ __('web.password') }}" />
                                    @error('password')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12 col-lg-6 col-md-6 col-xl-6">
                                <div class="mt-3">
                                    <label class="form-label">{{ __('web.confirm_password') }}</label>
                                    <input class="form-control @error('confirm_password') is-invalid @enderror"
                                        autocomplete="new-password" type="password" name="confirm_password"
                                        value="{{ old('confirm_password') }}"
                                        placeholder="{{ __('web.confirm_password') }}" />
                                    @error('password')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12 col-lg-6 col-md-6 col-xl-6">
                                <div class="mt-3">
                                    <label class="form-label">{{ __('web.phone') }}</label>
                                    <input class="form-control @error('phone') is-invalid @enderror" type="tel"
                                        name="phone" value="{{ old('phone') }}"
                                        placeholder="{{ __('web.phone') }}" />
                                    @error('phone')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-lg-6 col-md-6 col-xl-6">
                                <div class="mt-3">
                                    <label for="" class="form-label">{{ __('web.country') }}</label>
                                    <select class="form-control select2 @error('country_id') is-invalid @enderror"
                                        name="country_id">
                                        <option selected disabled>{{ __('web.country') }}</option>
                                        @isset($countries)
                                            @foreach ($countries as $country)
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

                            <div class="col-12 col-lg-6 col-md-6 col-xl-6">
                                <div class="mt-3">
                                    <label for="" class="form-label">{{ __('web.state') }}</label>
                                    <select class="form-control select2 @error('state') is-invalid @enderror"
                                        name="state_id">
                                        <option selected disabled>{{ __('web.state') }}</option>
                                    </select>
                                    @error('state_id')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12 col-lg-6 col-md-6 col-xl-6">
                                <div class="mt-3">
                                    <label for="" class="form-label">{{ __('web.city') }}</label>
                                    <select class="form-control select2 @error('city_id') is-invalid @enderror"
                                        name="city_id">
                                        <option selected disabled>{{ __('web.city') }}</option>
                                    </select>
                                    @error('city_id')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-lg-12 col-md-12 col-xl-12">
                                <div class="mt-3">
                                    <label for="" class="form-label">{{ __('web.address') }}</label>
                                    <input type="text" placeholder="{{ __('web.address') }}" name="address"
                                        class="form-control @error('address') is-invalid @enderror" placeholder=""
                                        aria-describedby="helpId" />
                                    @error('address')
                                        <small id="helpId" class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12 col-lg-6 col-md-6 col-xl-6">
                                <div class="mt-3">
                                    <label for="" class="form-label">{{ __('web.type_account') }}</label>
                                    <select class="form-control select2 @error('type_account') is-invalid @enderror"
                                        name="type_account">
                                        <option selected disabled>{{ __('web.type_account') }}</option>
                                        <option value="imported">imported</option>
                                        <option value="exporter">exporter</option>
                                    </select>
                                    @error('type_account')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12 col-lg-6 col-md-6 col-xl-6">
                                <div class="mt-3">
                                    <label for="" class="form-label">{{ __('web.status') }}</label>
                                    <select class="form-control select2 @error('status') is-invalid @enderror"
                                        name="status">
                                        <option selected disabled>{{ __('web.status') }}</option>
                                        <option value="active">active</option>
                                        <option value="inactive">inactive</option>
                                    </select>
                                    @error('status')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn ripple btn-primary" type="submit">{{ __('web.submit') }}</button>
                        <button class="btn ripple btn-secondary" data-dismiss="modal"
                            type="button">{{ __('web.close') }}</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <!-- End Modal Created Customer-->
@endsection
@section('js')
    <!-- Internal Data tables -->
    <script src="{{ URL::asset('backend/assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('backend/assets/plugins/datatable/js/dataTables.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('backend/assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('backend/assets/plugins/datatable/js/responsive.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('backend/assets/plugins/datatable/js/jquery.dataTables.js') }}"></script>
    <script src="{{ URL::asset('backend/assets/plugins/datatable/js/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ URL::asset('backend/assets/plugins/datatable/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ URL::asset('backend/assets/plugins/datatable/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ URL::asset('backend/assets/plugins/datatable/js/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('backend/assets/plugins/datatable/js/pdfmake.min.js') }}"></script>
    <script src="{{ URL::asset('backend/assets/plugins/datatable/js/vfs_fonts.js') }}"></script>
    <script src="{{ URL::asset('backend/assets/plugins/datatable/js/buttons.html5.min.js') }}"></script>
    <script src="{{ URL::asset('backend/assets/plugins/datatable/js/buttons.print.min.js') }}"></script>
    <script src="{{ URL::asset('backend/assets/plugins/datatable/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ URL::asset('backend/assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('backend/assets/plugins/datatable/js/responsive.bootstrap4.min.js') }}"></script>
    <!--Internal  Datatable js -->
    <script src="{{ URL::asset('backend/assets/js/table-data.js') }}"></script>

    <!--Internal  Datepicker js -->
    <script src="{{ URL::asset('backend/assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
    <!-- Internal Select2 js-->
    <script src="{{ URL::asset('backend/assets/plugins/select2/js/select2.min.js') }}"></script>
    <!-- Internal Modal js-->
    <script src="{{ URL::asset('backend/assets/js/modal.js') }}"></script>

    <script type="text/javascript" src="https://unpkg.com/default-passive-events"></script>
@endsection
