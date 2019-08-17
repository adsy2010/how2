@extends('layouts.app')

@section('content')
    <div class="container">
        @include('common.errors')
        @include('common.success')
        <h2>@lang('admin.dashboardtitle')</h2>
        <hr>
        <div class="row">

            @if(auth()->user()->hasPermission('User Admin'))
                <div class="col-md-4 col-sm-6" style="margin-bottom: 5px;"><a href="{{ Route('admin.users.list') }}" class="btn btn-primary btn-dashboard">@lang('admin.users')</a></div>
            @endif
            @if(auth()->user()->hasPermission('Group Admin'))
                <div class="col-md-4 col-sm-6" style="margin-bottom: 5px;"><a href="{{ Route('admin.usergroups.list') }}" class="btn btn-primary btn-dashboard">@lang('admin.groups')</a></div>
            @endif
            @if(auth()->user()->hasPermission('Permission Admin'))
                    <div class="col-md-4 col-sm-6" style="margin-bottom: 5px;"><a href="{{ Route('admin.permissions.list') }}" class="btn btn-primary btn-dashboard">@lang('admin.permissions')</a></div>
            @endif
                <div class="col-md-4 col-sm-6" style="margin-bottom: 5px;"><a href="{{ Route('admin.category.list') }}" class="btn btn-primary btn-dashboard">@lang('admin.categories')</a></div>
            @if(auth()->user()->hasPermission('Approve Guides'))
                <div class="col-md-4 col-sm-6" style="margin-bottom: 5px;"><a href="{{ Route('admin.approvals.list') }}" class="btn btn-primary btn-dashboard">@lang('admin.approvals')</a></div>
            @endif
                <div class="col-md-4 col-sm-6" style="margin-bottom: 5px;"><a href="{{ Route('admin.recache') }}" class="btn btn-primary btn-dashboard">Recache Search Terms</a></div>
                <div class="col-md-4 col-sm-6" style="margin-bottom: 5px;"><a href="{{ Route('admin.logs') }}" class="btn btn-primary btn-dashboard">Logs</a></div>


        </div>
    </div>
@endsection
