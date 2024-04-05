@extends('backend.layouts.master')

@section('title')
    {{ __('web.roles') }}
@endsection
@section('content')
    <div class="my-5">
    <div class="row">
        <div class="col-lg-12 margin-tb mb-3">
            <div class="pull-right">
                @can('create_role')
                    <a class="btn btn-success" href="{{ route('admin.roles.create') }}"> {{ __('web.create_roles') }}</a>
                @endcan
            </div>
        </div>
    </div>


    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif


    <table class="table table-bordered">
        <tr>
            <th>#</th>
            <th>{{ __('web.name') }}</th>
            <th width="280px">{{ __('web.actions') }}</th>
        </tr>
        @foreach ($roles as $key => $role)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $role->name }}</td>
                <td>
                    <a class="btn btn-info" href="{{ route('admin.roles.show',$role->id) }}">{{ __('web.show') }}</a>
                    @can('edit_role')
                        <a class="btn btn-primary" href="{{ route('admin.roles.edit',$role->id) }}">{{ __('web.edit') }}</a>
                    @endcan
                    @can('delete_role')
                        {!! Form::open(['method' => 'DELETE','route' => ['admin.roles.destroy', $role->id],'style'=>'display:inline']) !!}
                        {!! Form::submit(__('web.delete'), ['class' => 'btn btn-danger']) !!}
                        {!! Form::close() !!}
                    @endcan
                </td>
            </tr>
        @endforeach
    </table>


    {!! $roles->render() !!}


    <p class="text-center text-primary"><small>Tutorial by ItSolutionStuff.com</small></p>
    </div>
@endsection
