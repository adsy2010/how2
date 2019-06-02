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

        {{ Form::open() }}

        <h2>@lang('guides.generalTitle')</h2>
        <hr>
        <div id="guide-general">
            <div class="row">
                <div class="col-md-2">{{ Form::label('name', __('guides.nameLabel')) }}</div>
                <div class="col-md-10">{{ Form::text('name', null, ['class' => 'form-control']) }}</div>
            </div>
            <hr>

            <div class="row">
                <div class="col-md-2">{{ Form::label('category', __('guides.categoryLabel')) }}</div>
                <div class="col-md-10">{{ Form::select('category', [], null, ['class' => 'form-control']) }}</div>
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
                <div class="col-md-1">#</div>
                <div class="col-md-9">@lang('guides.contentLabel')</div>
                <div class="col-md-2">@lang('guides.supplementaryLabel')</div>
            </div>
            <br>
            <div class="row" id="steps-header">
                <div class="col-md-1">1{{ Form::hidden('step1', 1) }}</div>
                <div class="col-md-9">{{ Form::textarea('stepContent1', null,  ['class' => 'form-control', 'rows' => 2]) }}</div>
                <div class="col-md-2">{{ Form::file('supplementaryContent1') }}</div>
            </div>
            <hr>

            <div><a href="" class="btn btn-outline-secondary float-right">@lang('guides.addStepBtn')</a> @lang('guides.tooManyStepsInformation')</div>
        </div>
        <hr>

        {{ Form::submit('Submit new guide', ['class' => 'btn btn-primary']) }}
        {{ Form::close() }}

    </div>
@endsection