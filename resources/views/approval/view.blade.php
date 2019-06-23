@extends('layouts.app')

@section('content')
    <div class="container">
        <h4>@lang('guides.addTitle')</h4>
    @php
        //separating the data from the template
        $breadcrumbs = [
            ['title' => __('admin.dashboardtitle'), 'route' => 'admin.dashboard'],
            ['title' => __('approvals.viewTitle'), 'route' => 'admin.approvals.view']
        ];
    @endphp
    @include('common.errors')
    @include('common.success')
    @include('common.breadcrumb')




    </div>

@endsection