@extends('layouts.app')

@section('content')
    <div class="container">
        <h4>@lang('category.addTitle')</h4>
        @php
            //separating the data from the template
            $breadcrumbs = [
                ['title' => __('admin.dashboardtitle'), 'route' => 'admin.dashboard'],
                ['title' => __('category.listTitle'), 'route' => 'admin.category.list'],
                ['title' => __('category.addTitle'), 'route' => 'category.add']
            ];
        @endphp
        @include('common.errors')
        @include('common.success')
        @include('common.breadcrumb')

            {{ Form::open(['route' => 'admin.category.postadd']) }}
            {{ Form::label('name', 'Category name') }}
            {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Category name']) }}
            {{ Form::label('parent', 'Parent category') }}
            {{ Form::select('parent', $categories, null, ['class' => 'form-control', 'placeholder' => 'Select a parent category or leave blank for top level']) }}
        <hr>
            {{ Form::submit(__('category.addBtn'), ['class' => 'btn btn-primary']) }}
            {{ Form::close() }}


    </div>
@endsection
