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

    </div>
@endsection
