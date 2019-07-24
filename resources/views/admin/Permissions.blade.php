@extends('layouts.app')

@section('content')
    <div class="container">

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ Route('admin.dashboard') }}">@lang('admin.dashboardtitle')</a></li>
                <li class="breadcrumb-item active" aria-current="page">@lang('admin.permissionlisttitle')</li>
            </ol>
        </nav>
        @include('common.errors')
        @include('common.success')
        <h2>@lang('admin.permissionlisttitle')</h2>
        <hr>
        {{ Form::open(['route' => ['admin.permissions.add']]) }}
        <fieldset class="border p-4 rounded">
            <legend class="w-auto p-2 border rounded"><h4>@lang('admin.lbl-createpermission')</h4></legend>
            <p>@lang('admin.info-addpermissioninfo')</p>
            <hr>
            <div class="row">
                <div class="col-md-9">{{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => __('admin.lbl-permissionname')]) }}</div>
                <div class="col-md-3">{{ Form::submit(__('admin.btn-addnewpermission'), ['class' => 'btn btn-primary']) }}</div>
            </div>
        </fieldset>
        {{ Form::close() }}

        <table class="table table-hover">
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Groups</th>
                <th>Actions</th>
            </tr>
            @foreach($permissions as $permission)
                <tr>
                    <td>{{ $permission->id }}</td>
                    <td>{{ $permission->name }}</td>
                    <td>

                        @foreach($permission->rolepermissions->pluck('usergroups') as $p)
                            <a href="{{ Route('admin.usergroups.edit', ['id' => $p->pluck('id')->first()]) }}">
                                <div class="badge badge-pill badge-secondary p-2" style="font-weight: normal; font-size:14px;">{{ $p->pluck('name')->first() }}</div>
                            </a>
                        @endforeach

                    </td>
                    <td>
                        <a class="btn btn-danger disabled" href=""><span class="fas fa-trash"></span></a>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection