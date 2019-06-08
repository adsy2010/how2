@extends('layouts.app')

@section('content')
    <div class="container">
        <h4>@lang('guides.addTitle')</h4>
    @php
        //separating the data from the template
        $breadcrumbs = [
            ['title' => __('admin.dashboardtitle'), 'route' => 'admin.dashboard'],
            ['title' => __('approvals.approve'), 'route' => 'admin.approvals.approve']
        ];
    @endphp
    @include('common.errors')
    @include('common.success')
    @include('common.breadcrumb')

    @lang('approvals.areYouSureApprove')
        {{ Form::open() }}
        {{ Form::submit('Confirm', ['class' => 'btn btn-success']) }}
        <a href="" class="btn btn-primary">No, take me back!</a>
        {{ Form::close() }}
    </div>

@endsection