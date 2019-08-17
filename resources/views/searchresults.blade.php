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
    <table>
        @foreach($results->cache as $result)
        <tr>
            <td>{{ $result }}</td>
        </tr>
        @endforeach
    </table>
    </div>
@endsection
