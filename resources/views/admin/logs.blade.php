@extends('layouts.app')

@section('content')
    <div class="container">

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ Route('admin.dashboard') }}">@lang('admin.dashboardtitle')</a></li>
                <li class="breadcrumb-item active" aria-current="page">Logs</li>
            </ol>
        </nav>
        @include('common.errors')
        @include('common.success')
        <h2>Logs</h2>
        <hr>
        <table class="table table-hover">
            <tr>
                <th>User</th>
                <th>Comment</th>
                <th>Created at</th>
            </tr>
            @foreach($logs as $log)
                <tr>
                    <td>{{ $log->userInfo->name }}</td>
                    <td>{{ $log->action }}</td>
                    <td>{{ $log->created_at }}</td>
                </tr>
            @endforeach
        </table>
        {{ $logs->links() }}
    </div>
@endsection