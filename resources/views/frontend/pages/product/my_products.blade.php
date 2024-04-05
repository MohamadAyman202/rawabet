@extends('frontend.layouts.master')
@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.3/css/dataTables.bootstrap5.css" />
@endsection
@section('title')
    {{ __('web.products') }}
@endsection

@section('content')
    <section class="py-5">
        <div class=" container">
            <!-- row opened -->
            <div class="row row-sm">

                <!--div-->
                <div class="col-xl-12">
                    <div class="card mg-b-20">
                        <div class="card-header pb-0">
                            @include('inc.message')
                            <div class="d-flex justify-content-between align-items-center ">

                                <a href="{{ route('product_create') }}"
                                    class="btn btn-primary btn-md m-2">{{ __('web.create_products') }}</a>
                                <span>{{ __('web.count_products') }}: {{ count($products) }}</span>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example" class="table table-striped" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th class="border-bottom-0">#</th>
                                            <th class="border-bottom-0">{{ __('web.title') }}</th>
                                            <th class="border-bottom-0">{{ __('web.photo') }}</th>
                                            <th class="border-bottom-0">{{ __('web.category') }}</th>
                                            <th class="border-bottom-0">{{ __('web.sub_category') }}</th>
                                            <th class="border-bottom-0">{{ __('web.measuring_units') }}</th>
                                            <th class="border-bottom-0">{{ __('web.country') }}</th>
                                            <th class="border-bottom-0">{{ __('web.price') }}</th>
                                            <th class="border-bottom-0">{{ __('web.offer') }}</th>
                                            <th class="border-bottom-0">{{ __('web.quantity') }}</th>
                                            <th class="border-bottom-0">{{ __('web.status') }}</th>
                                            <th class="border-bottom-0">{{ __('web.admin_name') }}</th>
                                            <th class="border-bottom-0">{{ __('web.customer_name') }}</th>
                                            <th class="border-bottom-0">{{ __('web.created_at') }}</th>
                                            <th class="border-bottom-0">{{ __('web.updated_at') }}</th>
                                            <th class="border-bottom-0">{{ __('web.actions') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @isset($products)
                                            @foreach ($products as $product)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $product->title }}</td>
                                                    <td>
                                                        <a class="modal-effect btn btn-primary btn-sm" data-toggle="modal"
                                                            href="#view_photo{{ $product->slug }}">{{ __('web.photo') }}</a>
                                                    </td>
                                                    <td>{{ $product->category->title }}</td>
                                                    <td>{{ $product->sub_category->title }}</td>
                                                    <td>{{ $product->measuring_unit->title }}</td>
                                                    <td>{{ app()->getLocale() == 'en' ? $product->country->name : $product->country->native }}
                                                    </td>
                                                    <td>{{ $product->price }} {{ $product->country->currency_symbol }}</td>
                                                    <td>{{ $product->offers }} {{ $product->country->currency_symbol }}</td>
                                                    <td>{{ $product->quantity }}</td>
                                                    <td>
                                                        <span class="{{ $product->Status($product->status) }}">
                                                            {{ ucwords($product->status) }}
                                                        </span>
                                                    </td>
                                                    <td>{{ $product->admin?->name }}</td>
                                                    <td>{{ $product->user->name }}</td>
                                                    <td>
                                                        {{ $product->Fun($product->created_at) }}
                                                    </td>
                                                    <td>
                                                        {{ $product->Fun($product->updated_at) }}
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('product_edit', $product->slug) }}"
                                                            class="btn btn-primary btn-sm">{{ __('web.edit') }}</a>
                                                        <!-- Button trigger modal -->
                                                        <!--  Modal trigger button  -->
                                                        <button type="button" class="btn btn-danger btn-sm"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#delete{{ $product->slug }}">
                                                            {{ __('web.delete') }}
                                                        </button>


                                                    </td>
                                                </tr>

                                                <!-- Modal View Photo Category -->
                                                <div class="modal" id="view_photo{{ $product->slug }}">
                                                    <div class="modal-dialog modal-xl  modal-dialog-centered" role="document">
                                                        <div class="modal-content modal-content-demo">
                                                            <div class="modal-header">
                                                                <h6 class="modal-title">{{ __('web.photo') }}</h6>
                                                                <button aria-label="Close" class="close" data-dismiss="modal"
                                                                    type="button"><span
                                                                        aria-hidden="true">&times;</span></button>
                                                            </div>

                                                            <div class="modal-body">
                                                                <img src="{{ asset($product->photo) }}" alt="">
                                                            </div>
                                                            <div class="modal-footer">

                                                                <button class="btn ripple btn-secondary" data-dismiss="modal"
                                                                    type="button">{{ __('web.close') }}</button>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- End Modal View Photo Category-->

                                                <!-- Modal Delete Category -->
                                                <div class="modal fade" id="delete{{ $product->slug }}" tabindex="-1"
                                                    role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h6 class="modal-title">{{ __('web.delete_product') }}</h6>
                                                                <button aria-label="Close" class="close" data-dismiss="modal"
                                                                    type="button"><span
                                                                        aria-hidden="true">&times;</span></button>
                                                            </div>
                                                            <form action="{{ route('product_destroy', $product->slug) }}"
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
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">{{ __('web.close') }}</button>
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
                                <div class="d-flex justify-content-center align-items-center ">
                                    {!! $products->links() !!}
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <!--/div-->


            </div>
            <!-- /row -->
        </div>
    </section>

@endsection
@section('js')
    <script src="https://cdn.datatables.net/2.0.3/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.3/js/dataTables.bootstrap5.js"></script>
    <script>
        new DataTable('#example');
    </script>
@endsection
