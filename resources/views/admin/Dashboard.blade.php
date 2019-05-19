@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>@lang('admin.dashboardtitle')</h2>
        <hr>
        <div class="row">
            <div class="col-md-4 cols-sm-6"><a href="{{ Route('admin.users.list') }}" class="btn btn-primary btn-dashboard">@lang('admin.users')</a></div>
            <div class="col-md-4 cols-sm-6"><a href="{{ Route('admin.usergroups.list') }}" class="btn btn-primary btn-dashboard">@lang('admin.groups')</a></div>
        </div>

    </div>
@endsection