@extends('layouts.app')

@section('content')
    <div class="container">
        <h4>@lang('category.updateTitle')</h4>
        @php
            //separating the data from the template
            $breadcrumbs = [
                ['title' => __('admin.dashboardtitle'), 'route' => 'admin.dashboard'],
                ['title' => __('category.listTitle'), 'route' => 'admin.category.list']
                ];

            if(isset($category->parentInfo)) $breadcrumbs[] = ['title' => $category->parentInfo->name, 'route' => 'admin.category.list.children','routedata' => $category->parentInfo->id];

            if(!empty($category))
                $breadcrumbs[] = ['title' => __('category.updateTitle'), 'route' => 'admin. category.edit']
        @endphp

        @include('common.errors')
        @include('common.success')
        @include('common.breadcrumb')

        {{ Form::open(['route' => ['admin.category.postedit', 'id' => $category->id]]) }}
        {{ Form::model($category) }}
        {{ Form::label('name', 'Category name') }}
        {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Category name']) }}
        {{ Form::label('parent', 'Parent category') }}
        {{ Form::select('parent', $categories, null, ['class' => 'form-control', 'placeholder' => 'Select one or none...']) }}
        <hr>
        {{ Form::submit(__('category.updateBtn'), ['class' => 'btn btn-primary']) }}
        {{ Form::close() }}

    </div>
@endsection
