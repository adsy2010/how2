@extends('layouts.app')

@section('content')
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ Route('admin.dashboard') }}">@lang('admin.dashboardtitle')</a></li>
                <li class="breadcrumb-item"><a href="{{ Route('admin.usergroups.list') }}">@lang('admin.usergrouplisttitle')</a></li>
                <li class="breadcrumb-item"><a href="{{ Route('admin.usergroups.edit', ['id' => $group->id]) }}">{{ $group->name }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">@lang('admin.usergroupdeletetitle') - {{ $group->name }}</li>
            </ol>
        </nav>
        <h2>@lang('admin.usergroupdeletetitle') - {{ $group->name }}</h2>
        <hr>
        <fieldset class="border p-4 rounded">
            <legend class="border w-auto p-2">Are you sure you want to delete this group and all its memberships?</legend>
            {{ Form::open(['route' => ['admin.usergroups.deleteconfirm', 'id' => $group->id]]) }}
            <input type="submit" class="btn btn-danger" value="Yes, I really am sure!">

            <a href="{{ Route('admin.usergroups.edit', ['id' => $group->id]) }}" class="btn btn-primary">No, get me out of here!</a>{{ Form::close() }}
        </fieldset>


    </div>
@endsection