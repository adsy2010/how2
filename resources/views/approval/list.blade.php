@extends('layouts.app')

@section('content')
    <div class="container">
        <h4>@lang('approvals.listTitle')</h4>
    @php
        //separating the data from the template
        $breadcrumbs = [
            ['title' => __('admin.dashboardtitle'), 'route' => 'admin.dashboard'],
            ['title' => __('approvals.listTitle'), 'route' => 'admin.approvals.list']
        ];
    @endphp
    @include('common.errors')
    @include('common.success')
    @include('common.breadcrumb')

    <table class="table table-hover">
        <tr>
            <th>#</th>
            <th>Guide</th>
            <th>Steps</th>
            <th>Creator</th>
            <th>Actions</th>
        </tr>
        @foreach($approvals as $approval)
        <tr>
            <td>{{ $approval->id }}</td>
            <td>{{ $approval->guideInfo->name }}</td>
            <td>{{ $approval->guideInfo->steps->count() }}</td>
            <td>{{ $approval->userInfo->name }}</td>
            <td>
                <a href="{{ Route('admin.approvals.view', ['id' => $approval->id]) }}" class="btn btn-primary"><span class="fas fa-eye"></span> View</a>
                <a href="{{ Route('admin.approvals.approve', ['id' => $approval->id]) }}" class="btn btn-primary"><span class="fas fa-check"></span> Approve</a>
                <a href="{{ Route('admin.approvals.reject', ['id' => $approval->id]) }}" class="btn btn-primary"><span class="fas fa-times"></span> Reject</a>
            </td>
        </tr>
        @endforeach
    </table>
    </div>

@endsection