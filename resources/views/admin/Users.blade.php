@extends('layouts.app')

@section('content')
    <div class="container">
        <h4>@lang('admin.userlisttitle')</h4>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ Route('admin.dashboard') }}">@lang('admin.dashboardtitle')</a></li>
                <li class="breadcrumb-item active" aria-current="page">@lang('admin.userlisttitle')</li>
            </ol>
        </nav>

        <div>@lang('admin.info-userlist')</div>

        <table class="table table-hover">
            <tr>
                <th>#</th>
                <th>@lang('generic.name')</th>
                <th>@lang('generic.email')</th>
                <th>@lang('generic.created')</th>
            </tr>

            @foreach ($users as $user)

                <tr class="clickable-row" data-href="{{ Route('admin.users.view', $user->id) }}">
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->created_at }}</td>
                </tr>

            @endforeach
        </table>

    </div>

@endsection