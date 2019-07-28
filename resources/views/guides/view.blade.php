@extends('layouts.app')

@section('content')
    <div class="container">
        <h4>@lang('guides.title')</h4>
        @php
            //separating the data from the template
            $breadcrumbs = [
                ['title' => __('generic.home'), 'route' => 'root'], //change to homepage
                ['title' => __('guides.title'), 'route' => 'category.list'], //show current category
                ['title' => $guide->name, 'route' => 'category.list'] //show current guide name
            ]; //fix links
        @endphp
        @include('common.errors')
        @include('common.success')
        @include('common.breadcrumb')

        <div class="jumbotron">
            <h1>{{ $guide->name }}</h1>
            <p>{{ $guide->description }}</p>
        </div>
        <fieldset>
            <legend><h4>@lang('guides.rateTitle')</h4></legend>
            <div class="row">
                <div class="col-md-3 text-center">
                    <a style="color:white;" onclick="rate('{{ Route('guide.rate', ['id' => $guide->id]) }}', 'helpful', '{{ csrf_token() }}')" class="btn btn-primary"><span class="far fa-thumbs-up"></span> @lang('guides.helpfulLabel')</a>
                    <a style="color:white;" onclick="rate('{{ Route('guide.rate', ['id' => $guide->id]) }}', 'unhelpful', '{{ csrf_token() }}')" class="btn btn-danger"><span class="far fa-thumbs-down"></span> @lang('guides.unhelpfulLabel')</a>
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

        @if(auth()->user()->id == $guide->publisher || auth()->user()->hasPermission('Administrator'))
            {{-- Add a check to see if the guide is actually published --}}
            <a class="btn btn-outline-primary float-right disabled" href="">Unpublish</a>
        @endif
        @lang('guides.categoryLabel'): {{ $guide->categoryInfo->name }}<br>
        @lang('guides.tagLabel'): {{ (!empty($guide->tags)) ? $guide->tags : 'No tags defined for this guide' }}

        <hr>
        <h2>@lang('guides.stepsTitle')</h2>
        <hr>
        @foreach($guide->steps as $step)
            <div class="row steps p-2 m-2 rounded">
                    <div class="col-md-2" style="vertical-align: middle; " ><p class="lead">@lang('guides.stepLabel') # {{ $step->stepNumber }}</p></div>
                    <div class="col-md-8"><p class="lead" style="font-size: 20px; text-align: justify; ">{{ $step->stepContent }}</p></div>
                    <div class="col-md-2">

                        @if(sizeof($step->supplementaryContent) > 0)
                            @if($step->supplementaryContent->pluck('dataType') == '1')
                                video
                            @else
                                <img class="img-thumbnail" src="{{ stripslashes($step->supplementaryContent->pluck('contentLocation')[0]) }}" />
                            @endif

                        @endif

                    </div>
            </div>

        @endforeach
        <hr>
        <h2>@lang('guides.feedbackTitle')</h2>
        <hr>
        {{ Form::open(['url' => Route('guide.feedback', ['id' => $guide->id])]) }}
        {{ Form::textarea('feedback', null, ['rows' => 2,'class' => 'form-control']) }}
        {{ Form::submit('Send feedback to author', ['class' => 'btn btn-primary']) }}
        {{ Form::close() }}

        @php($myFeedback = auth()->user()->feedback->where('guide', $guide->id))

        @if($myFeedback->count() > 0)
            <hr>
            <h4>My feedback for this guide</h4>
            @foreach($myFeedback as $feedback)
                <div class="row container" style="border-bottom: #aeaeae 0.5px solid;">
                    <div class="col-md-3">{{ $feedback->created_at }}</div>
                    <div class="col-md-9">{{ $feedback->comment }}</div>
                </div>
            @endforeach
        @endif

    </div>
@endsection