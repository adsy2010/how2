@extends('layouts.app')

@section('content')
    <div class="container">
        <h4>@lang('category.listTitle')</h4>
        @php
            //separating the data from the template
            $breadcrumbs = [
                ['title' => __('generic.home'), 'route' => 'root'], //change to homepage
                ['title' => __('category.listTitle'), 'route' => 'category.list'], //show current category
                ['title' => __('category.listTitle'), 'route' => 'category.list'] //show current guide name
            ];
        @endphp
        @include('common.errors')
        @include('common.success')
        @include('common.breadcrumb')

        <div class="jumbotron">
            <h1>GUIDE NAME</h1>
            <p>GUIDE DESCRIPTION - may add this later</p>
        </div>
        <h4>Rate this guide</h4>
        <a href="" class="btn btn-primary"><span class="far fa-thumbs-up"></span> HELPFUL</a>
        <a href="" class="btn btn-danger"><span class="far fa-thumbs-down"></span> UNHELPFUL</a>
        <hr>
        CATEGORY & TAGS

        <hr>
        <h2>@lang('guides.stepsTitle')</h2>
        <hr>
        foreach

        steps

        STEP NUMBER
        STEP CONTENT
        STEP SUPPLEMENTARY CONTENT
        <hr>
        <h2>@lang('guides.feedbackTitle')</h2>
        <hr>
        {{ Form::open() }}
        {{ Form::textarea('feedback', null, ['rows' => 2,'class' => 'form-control']) }}
        {{ Form::submit('Send feedback to author', ['class' => 'btn btn-primary']) }}
        {{ Form::close() }}

    </div>
@endsection