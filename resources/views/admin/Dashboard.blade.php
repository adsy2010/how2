@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>@lang('admin.dashboardtitle')</h2>
        <hr>
        <div class="row">
            <div class="col-md-4 col-sm-6" style="margin-bottom: 5px;"><a href="{{ Route('admin.users.list') }}" class="btn btn-primary btn-dashboard">@lang('admin.users')</a></div>
            <div class="col-md-4 col-sm-6" style="margin-bottom: 5px;"><a href="{{ Route('admin.usergroups.list') }}" class="btn btn-primary btn-dashboard">@lang('admin.groups')</a></div>
            <div class="col-md-4 col-sm-6" style="margin-bottom: 5px;"><a href="{{ Route('admin.permissions.list') }}" class="btn btn-primary btn-dashboard">@lang('admin.permissions')</a></div>
            <div class="col-md-4 col-sm-6" style="margin-bottom: 5px;"><a href="{{ Route('admin.category.list') }}" class="btn btn-primary btn-dashboard">@lang('admin.categories')</a></div>
            <div class="col-md-4 col-sm-6" style="margin-bottom: 5px;"><a href="{{ Route('admin.approvals.list') }}" class="btn btn-primary btn-dashboard">@lang('admin.approvals')</a></div>
        </div>

    </div>
@endsection