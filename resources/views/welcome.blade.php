@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="jumbotron">
            <h4>Dashboard</h4>
            <hr>
            <p class="lead">Welcome to the HowTo Guide system. Feel free to browse the guides available and provide feedback
                where you feel it is needed.
            </p>
        </div>
        <h4>Latest Guides</h4>
        <hr>
        <div class="row p-2 m-2 rounded">
            <div class="col-9 d-sm-none d-none d-md-block"><h4>Guide</h4></div>
            <div class="col-1 d-sm-none d-none d-md-block"><h4>Steps</h4></div>
            <div class="col-2 d-sm-none d-none d-md-block" align="center"><h4>Rating</h4></div>
        </div>
        @foreach($guides as $guide)

            <div data-href="{{ Route('guide.view', ['id' => $guide->id]) }}" class="clickable-row list-guide-item row steps p-4 m-4 rounded">
                <div class="col-md-9 col-sm-9 col-9">
                    <p class="lead" style="font-size: 20px;">{{ $guide->name }}</p>
                </div>
                <div class="col-md-1 col-sm-3 col-3">
                   {{ $guide->steps->count() }} {{ Str::plural('step', $guide->steps->count()) }}<br>
                </div>
                <div class="col-md-2 col-sm-12 col-12">
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
                <div class="col-12"><p class="small">Published: {{ Carbon\Carbon::parse($guide->publishedTimestamp)->isoFormat('ll') }} at {{ Carbon\Carbon::parse($guide->publishedTimestamp)->isoFormat('LT') }}</p></div>
            </div>

        @endforeach

        <a href="" class="form-control btn btn-primary">Load more...</a>

    </div>
@endsection
