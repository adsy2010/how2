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
            <h1>{{ $guide->name }}</h1>
            <p>GUIDE DESCRIPTION - may add this later</p>
        </div>
        <fieldset>
            <legend><h4>Rate this guide</h4></legend>
            <div class="row">
                <div class="col-md-3 text-center">
                    <a style="color:white;" onclick="rate('{{ Route('guide.rate', ['id' => $guide->id]) }}', 'helpful', '{{ csrf_token() }}')" class="btn btn-primary"><span class="far fa-thumbs-up"></span> HELPFUL</a>
                    <a style="color:white;" onclick="rate('{{ Route('guide.rate', ['id' => $guide->id]) }}', 'unhelpful', '{{ csrf_token() }}')" class="btn btn-danger"><span class="far fa-thumbs-down"></span> UNHELPFUL</a>
                </div>
                <div class="col-md-8">
                    @php
                        $ratings = $guide->helpful + $guide->unhelpful;
                        $helpful = ($ratings > 0 && $guide->helpful > 0)     ? round(($guide->helpful / $ratings) * 100) : 0;
                        $unhelpful = ($ratings > 0 && $guide->unhelpful > 0) ? round(($guide->unhelpful / $ratings) * 100) : 0;
                    @endphp
                    <div class="progress m-2">
                        <div id='helpfulbar' class="progress-bar bg-success" role="progressbar" style="width: {{ $helpful }}%" aria-valuenow="{{ $guide->helpful }}" aria-valuemin="0" aria-valuemax="{{ $ratings }}"></div>
                        <div id='unhelpfulbar' class="progress-bar bg-danger" role="progressbar" style="width: {{ $unhelpful }}%" aria-valuenow="{{ $guide->unhelpful }}" aria-valuemin="0" aria-valuemax="{{ $ratings }}"></div>
                    </div>
                </div>

            </div>
        </fieldset>

        <hr>
        @lang('guides.categoryLabel'): {{ $guide->categoryInfo->name }}<br>
        @lang('guides.tagLabel'): {{ (!empty($guide->tags)) ? $guide->tags : 'No tags defined for this guide' }}

        <hr>
        <h2>@lang('guides.stepsTitle')</h2>
        <hr>
        @foreach($guide->steps as $step)
            <div class="row steps p-2 m-2 rounded">
                    <div class="col-md-2" style="vertical-align: middle; " ><p class="lead">@lang('guides.stepLabel') # {{ $step->stepNumber }}</p></div>
                    <div class="col-md-8"><p class="lead" style="font-size: 20px; text-align: justify; ">{{ $step->stepContent }}</p></div>
                    <div class="col-md-2"><img class="img-thumbnail" src="https://via.placeholder.com/150" /></div>
            </div>

        @endforeach
        <hr>
        <h2>@lang('guides.feedbackTitle')</h2>
        <hr>
        {{ Form::open(['url' => Route('guide.feedback', ['id' => $guide->id])]) }}
        {{ Form::textarea('feedback', null, ['rows' => 2,'class' => 'form-control']) }}
        {{ Form::submit('Send feedback to author', ['class' => 'btn btn-primary']) }}
        {{ Form::close() }}

    </div>
@endsection