@extends('layouts.app')

@section('content')
    <div class="container">
        <h4>@lang('admin.usertitle') - {{ $user->name }}</h4>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ Route('admin.dashboard') }}">@lang('admin.dashboardtitle')</a></li>
                <li class="breadcrumb-item"><a href="{{ Route('admin.users.list') }}">@lang('admin.userlisttitle')</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $user->name }}</li>
            </ol>
        </nav>
        @include('common.errors')
        @include('common.success')

        <h4>Group Memberships</h4>
        @php($usergroups = $user->usergroups->pluck('groupInfo'))

        @foreach($usergroups as $group)
            <div class="row p-2 border">
                <div class="col-md-5">{{ $group->name }} </div>
                <div class="col-md-2">
                    {{ Form::open(['route' => ['admin.usersgroups.unassign', 'id' => $user->id]]  ) }}
                    {{ Form::hidden('groupID', $group->id) }}
                    {{ Form::button('<span class="fas fa-trash"></span> Remove from group', ['type' => 'submit','class' => 'btn btn-danger']) }}
                    {{ Form::close() }}
                </div>


            </div>
        @endforeach
        <hr>
        <h4>Add to group</h4>
        {{ Form::open(['route' => ['admin.usersgroups.assign', $user->id]]) }}
        <div class="row">
            <div class="col-md-9">{{ Form::select('group', $groups, null, ['class' => 'form-control']) }}</div>
            <div class="col-md-3">{{ Form::submit(__('admin.btn-addtogroup'), ['class' => 'btn btn-primary w-100']) }}</div>
        </div>
        {{ Form::close() }}
    </div>


@endsection