@extends('layouts.app')

@section('content')
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ Route('admin.dashboard') }}">@lang('admin.dashboardtitle')</a></li>
                <li class="breadcrumb-item active" aria-current="page">@lang('admin.usergrouplisttitle')</li>
            </ol>
        </nav>
        <h2>@lang('admin.usergrouplisttitle')</h2>
        <hr>
        @include('common.errors')
        @include('common.success')
        {{ Form::open(['route' => 'admin.usergroups.add']) }}
        <fieldset class="border p-4 rounded">
            <legend class="w-auto p-2 border rounded"><h4>@lang('admin.lbl-createusergroup')</h4></legend>
            <p>@lang('admin.info-addgroupinfo')</p>
            <hr>
            <div class="row">
                <div class="col-md-9">{{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => __('admin.lbl-groupname')]) }}</div>
                <div class="col-md-3">{{ Form::submit(__('admin.btn-addnewgroup'), ['class' => 'btn btn-primary']) }}</div>
            </div>
        </fieldset>

        {{ Form::close() }}
        <hr>
        <div class="alert">@lang('admin.info-usergroups')</div>
        <hr>
        <table class="table table-hover">
            <tr>
                <th>#</th>
                <th>@lang('generic.name')</th>
                <th>@lang('generic.created')</th>
                <th width="200">@lang('generic.actions')</th>
            </tr>

            @foreach ($groups as $group)
                <tr class="clickable-row" data-href="{{ Route('admin.usergroups.edit', ['id' => $group->id]) }}">
                    <td>{{ $group->id }}</td>
                    <td>{{ $group->name }}</td>
                    <td>{{ $group->created_at }}</td>
                    <td><a class="btn btn-danger" href="{{ Route('admin.usergroups.delete', ['id' => $group->id]) }}"><span class="fas fa-trash"></span></a></td>
                </tr>

            @endforeach
        </table>
    </div>

@endsection