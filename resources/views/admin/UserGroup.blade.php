@extends('layouts.app')

@section('content')
    <div class="container">

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ Route('admin.dashboard') }}">@lang('admin.dashboardtitle')</a></li>
                <li class="breadcrumb-item"><a href="{{ Route('admin.usergroups.list') }}">@lang('admin.usergrouplisttitle')</a></li>
                <li class="breadcrumb-item active" aria-current="page">@lang('admin.usergrouptitle') - {{ $group->name }}</li>
            </ol>
        </nav>
        @include('common.errors')
        @include('common.success')
        <h2>@lang('admin.usergrouptitle') - {{ $group->name }}</h2>
        <hr>
        {{ Form::open(['route' => ['admin.usergroups.update', 'id' => $group->id]]) }}
        {{ Form::model($group) }}
        <fieldset class="border p-4 m-2 rounded">
            <legend class="w-auto p-2 border rounded"><h4>@lang('admin.lbl-updateusergroup')</h4></legend>
            <p>@lang('admin.info-updategroupinfo')</p>
            <hr>
            <div class="row">
                <div class="col-md-9">{{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => __('admin.lbl-groupname')]) }}</div>
                <div class="col-md-3">{{ Form::submit(__('admin.btn-updategroup'), ['class' => 'btn btn-primary']) }}</div>
            </div>
        </fieldset>
        {{ Form::close() }}

        <fieldset class="border p-4 m-2 rounded">
            <legend class="w-auto p-2 border rounded"><h4>Add permission to group</h4></legend>
            {{ Form::open(['route' => ['admin.usergroups.permission.assign', $group->id]]) }}
            <div class="row">
                <div class="col-md-9">{{ Form::select('group', $permissions, null, ['class' => 'form-control']) }}</div>
                <div class="col-md-3">{{ Form::submit(__('admin.btn-addtogroup'), ['class' => 'btn btn-primary w-100']) }}</div>
            </div>
            {{ Form::close() }}
        </fieldset>

        <hr>
        <h4>Assigned Permissions</h4>
        <table class="table table-hover">
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Options</th>
            </tr>

            @foreach($group->permissions->pluck('permissions') as $permission)
                <tr>
                    <td>{{ $permission->first()->id }}</td>
                    <td>{{ $permission->first()->name }}</td>
                    <td>
                        {{ Form::open(['route' => ['admin.usergroups.permission.unassign', 'id' => $group->id]]  ) }}
                        {{ Form::hidden('permissionID', $permission->first()->id) }}
                        {{ Form::button('<span class="fas fa-trash"></span> Remove from group', ['type' => 'submit','class' => 'btn btn-danger']) }}
                        {{ Form::close() }}
                    </td>
                </tr>

            @endforeach

        </table>


        <hr>
        <h4>Group members</h4>
        <table class="table table-hover">
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Options</th>
            </tr>
            @foreach($group->members->pluck('user') as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>
                        {{ Form::open(['route' => ['admin.usersgroups.unassign', 'id' => $user->id]]  ) }}
                        {{ Form::hidden('groupID', $group->id) }}
                        {{ Form::button('<span class="fas fa-trash"></span> Remove from group', ['type' => 'submit','class' => 'btn btn-danger']) }}
                        {{ Form::close() }}
                    </td>
                </tr>

            @endforeach
        </table>

    </div>
@endsection