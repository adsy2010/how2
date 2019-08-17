@extends('layouts.app')

@section('content')
    <div class="container">
        <h4>Search Results</h4>
    @php
        //separating the data from the template
        $breadcrumbs = [
            ['title' => 'Home', 'route' => 'root'],
            ['title' => 'Search Results', 'route' => '']
        ];
    @endphp
    @include('common.errors')
    @include('common.success')
    @include('common.breadcrumb')
        <h4> Search term :: "{{ $results->term }}"</h4>
        <hr>
        <h5>Matching results</h5>
    <table class="table table-hover">
        <tr>
            <th>#</th>
            <th>Guide</th>
            <th>Last Updated</th>
        </tr>
        @foreach($results->cache as $item => $result)
        <tr class="clickable-row" data-href="{{ Route('guide.view', ['id' => $result->guideId]) }}">
            <td>{{ $item +1 }}</td>
            <td>{{ $result->guide->name }}</td>
            <td>{{ $result->guide->updated_at }}</td>
        </tr>
        @endforeach
    </table>
    </div>
@endsection
