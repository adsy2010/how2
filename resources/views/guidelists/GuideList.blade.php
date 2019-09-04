@extends('layouts.app')

@section('content')
    <div class="container">

        @php
            //separating the data from the template
            $breadcrumbs = [
                ['title' => __('generic.home'), 'route' => 'root'],
                ['title' => 'My Guide Lists', 'route' => 'guidelist.list'],
                ['title' => $guidelist->name, 'route' => 'guidelist.view']
            ];
        @endphp
        @include('common.errors')
        @include('common.success')
        @include('common.breadcrumb')


        <h2>{{ $guidelist->name }}</h2>
        <hr>
        @foreach($guidelist->guidelistItems as $items)
            @foreach($items->guideInfo as $guide)
                {{ $guide->name }}
            @endforeach
        @endforeach
    </div>
@endsection