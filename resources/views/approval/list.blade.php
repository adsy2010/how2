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
            <th>Creator</th>
            <th>Actions</th>
        </tr>
        @foreach([] as $guide)
        <tr>
            <td>{{ $guide->id }}</td>
            <td>{{ $guide->name }}</td>
            <td>{{ $guide->publisher->pluck('name') }}</td>
            <td>
                <a href="" class="btn btn-primary"><span class="fas fa-eye"></span> View</a>
                <a href="" class="btn btn-primary"><span class="fas fa-check"></span> Approve</a>
                <a href="" class="btn btn-primary"><span class="fas fa-times"></span> Reject</a>
            </td>
        </tr>
        @endforeach
    </table>
    </div>

@endsection