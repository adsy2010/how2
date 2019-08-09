@extends('layouts.app')

@section('content')
    <div class="container">

        @php
            //separating the data from the template
            $breadcrumbs = [
                ['title' => __('generic.home'), 'route' => 'root'],
                ['title' => 'My Guide Lists', 'route' => 'guidelist.list']
            ];
        @endphp
        @include('common.errors')
        @include('common.success')
        @include('common.breadcrumb')

        <h2>Delete guide list?</h2>
        <hr>
        <a href="" class="btn btn-danger">Confirm deletion of this guide list and all its shares?</a>
        <a href="" class="btn btn-primary">Go back to my guide lists</a>
    </div>
@endsection