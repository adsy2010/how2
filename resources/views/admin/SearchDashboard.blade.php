@extends('layouts.app')

@section('content')
    <div class="container">
        <h4>Search Results</h4>
        @php
            //separating the data from the template
            $breadcrumbs = [
                ['title' => 'Admin Dashboard', 'route' => 'admin.dashboard'],
                ['title' => 'Search Dashboard', 'route' => '']
            ];
        @endphp
        @include('common.errors')
        @include('common.success')
        @include('common.breadcrumb')

        <div class="row">
            <div class="col-md-4 col-sm-6" style="margin-bottom: 5px;"><a href="{{ Route('admin.search.clear.cache') }}" class="btn btn-primary btn-dashboard">Clear search cache</a></div>
            <div class="col-md-4 col-sm-6" style="margin-bottom: 5px;"><a href="{{ Route('admin.search.clear.terms') }}" class="btn btn-primary btn-dashboard">Clear all search terms</a></div>
            <div class="col-md-4 col-sm-6" style="margin-bottom: 5px;"><a href="{{ Route('admin.search.recache') }}" class="btn btn-primary btn-dashboard">Recache search terms</a></div>
        </div>

        <hr>
        <h4>Search Terms</h4>

        @foreach($terms as $term)
            <a href="{{ Route('search.view.id', [$term->id])}}"><div class="badge badge-pill badge-secondary" style="font-size: 24px; padding: 18px; margin:5px;">{{ $term->term }}</div></a>
        @endforeach
        <hr>
        {{ $terms->links() }}

    </div>
@endsection
