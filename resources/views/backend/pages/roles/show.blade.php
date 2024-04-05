@extends('backend.layouts.master')

@section('title')
    {{ __('web.show_roles') }}
@endsection

@section('content')
    <div class="my-5">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>{{ __('web.show_roles') }}</h2>
            </div>
            <div class="pull-right my-3">
                <a class="btn btn-primary" href="{{ route('admin.roles.index') }}">{{ __('web.back') }}</a>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('web.name') }}:</strong>
                {{ $role->name }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('web.permission') }}:</strong>
                <ol>
                @if(!empty($rolePermissions))
                    @foreach($rolePermissions as $v)
                        <li class="label label-success">{{ $v->name }}</li>
                    @endforeach
                @endif
                </ol>
            </div>
        </div>
    </div>
    </div>
@endsection
