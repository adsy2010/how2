@extends('layouts.app')

@section('content')
    <div class="container">
        <h4>@lang('guides.addTitle')</h4>
        @php
            //separating the data from the template
            $breadcrumbs = [
                ['title' => __('generic.home'), 'route' => 'root'],
                ['title' => __('guides.addTitle'), 'route' => 'guide.add']
            ];
        @endphp
        @include('common.errors')
        @include('common.success')
        @include('common.breadcrumb')


        <div class="jumbotron">
            <h4>@lang('guides.informationTitle')</h4>
            <p class="lead">
                @lang('guides.addInformation')
            </p>
        </div>

        {{ Form::open(['files' => true]) }}

        <h2>@lang('guides.generalTitle')</h2>
        <hr>
        <div id="guide-general">
            <div class="row">
                <div class="col-md-2">{{ Form::label('name', __('guides.nameLabel')) }} @lang('generic.required')</div>
                <div class="col-md-10">{{ Form::text('name', null, ['class' => 'form-control']) }}</div>
            </div>
            <hr>

            <div class="row">
                <div class="col-md-2">{{ Form::label('category', __('guides.selectCategoryLabel')) }} @lang('generic.required')</div>
                <div class="col-md-10">{{ Form::select('category', $categories, null, ['class' => 'form-control']) }}</div>
            </div>
            <hr>

            <div class="row">
                <div class="col-md-2">{{ Form::label('tags', __('guides.tagLabel')) }}</div>
                <div class="col-md-10">{{ Form::text('tags', null, ['class' => 'form-control']) }}</div>
            </div>
            <hr>

            <div class="row">
                <div class="col-md-2">{{ Form::label('restrictedGroup', __('guides.restrictLabel')) }}</div>
                <div class="col-md-10">{{ Form::select('restrictedGroup', [], null, ['class' => 'form-control']) }}</div>
            </div>
        </div>
        <hr>
        <h2>@lang('guides.stepsTitle')</h2>
        <hr>
        <div id="guide-steps">

            <div class="row" id="steps-header">
                <div class="col-md-10">@lang('guides.contentLabel')</div>
                <div class="col-md-2">@lang('guides.supplementaryLabel')</div>
            </div>
            <br>
            <div id="steplist">
                <div class="row step">
                    <div class="col-md-10">{{ Form::textarea('step[content][]', null,  ['class' => 'form-control', 'rows' => 2]) }}</div>
                    <div class="col-md-2">{{ Form::file('step[supplementary][]') }}</div>
                </div>
                <hr>
            </div>


            <div class="p-2"><a onclick="addStep()" class="btn btn-outline-primary float-right">@lang('guides.addStepBtn')</a> @lang('guides.tooManyStepsInformation')</div>
        </div>
        <hr>

        {{ Form::submit('Submit new guide', ['class' => 'btn btn-primary']) }}
        {{ Form::close() }}

    </div>
@endsection