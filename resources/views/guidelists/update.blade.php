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

        <h2>Update Guide List</h2>
        <hr>
        {{ Form::open() }}
        {{ Form::model($guidelist) }}
        <div class="row">
            <div class="col-md-8">{{ Form::text('name', null, ['class' => 'form-control']) }}</div>
            <div class="col-md-4">{{ Form::submit('Update guide list title', null, ['class' => 'btn btn-warning form-control']) }}</div>
        </div>
        {{ Form::close() }}
    </div>
@endsection