@extends('layouts.app')

@section('content')
    <div class="container">
        <h4>@lang('guides.addTitle')</h4>
    @php
        //separating the data from the template
        $breadcrumbs = [
            ['title' => __('admin.dashboardtitle'), 'route' => 'admin.dashboard'],
            ['title' => __('approvals.reject'), 'route' => 'admin.approvals.reject']
        ];
    @endphp
    @include('common.errors')
    @include('common.success')
    @include('common.breadcrumb')

    @lang('approvals.areYouSureReject')

    {{ Form::open() }}
    {{ Form::submit('Confirm', ['class' => 'btn btn-danger']) }}
        <a href="" class="btn btn-primary">No, take me back!</a>
    {{ Form::close() }}
    </div>

@endsection
