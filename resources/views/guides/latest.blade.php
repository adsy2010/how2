@extends('layouts.app')

@section('content')
    <div class="container">
        <h4>Guides - {{ $viewname }}</h4>
        <hr>
        <p class="lead">Guides are shown in order of newest published first.</p>
        <div class="row">
            @foreach($guides as $guide)
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div data-href="{{ Route('guide.view', ['id' => $guide->id]) }}" class="card clickable-row list-guide-item m-2 rounded" style="height: 240px;">
                        <div class="card-header bg-info">
                            <p class="lead" style="font-size: 20px;">{{ $guide->name }}</p>
                        </div>
                        <div class="card-body">
                            {{ $guide->steps->count() }} {{ Str::plural('step', $guide->steps->count()) }}<br>
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
                        <div class="card-footer" style="height: 40px;"><p class="small">Published: {{ Carbon\Carbon::parse($guide->publishedTimestamp)->isoFormat('ll') }} at {{ Carbon\Carbon::parse($guide->publishedTimestamp)->isoFormat('LT') }}</p></div>
                    </div>
                </div>


            @endforeach
            {{ $guides->links() }}
        </div>


    </div>
@endsection
