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

        <h2>My Guide Lists</h2>
        <hr>
        <div class="card">
            <div class="card-header bg-primary"><h4 style="color: white;">My Lists</h4></div>
            <div class="card-body">
                <p class="lead">Guide lists you have created, newest first will appear below.</p>
                <table class="table table-hover">
                    <tr>
                        <th>Name</th>
                        <th>Action</th>
                    </tr>

                    <tr>
                    <tr>
                        <td colspan="2">You currently have no guide lists.</td>
                    </tr>
                    </tr>
                </table>
                {{ Form::open(['route' => 'guidelist.add']) }}
                <div class="row">
                    <div class="col-md-8">{{ Form::text('name', null, ['placeholder' => 'List name', 'class'=>'form-control']) }}</div>
                    <div class="col-md-4">{{ Form::submit('Create a new guide list', ['class'=>'btn btn-success form-control']) }}</div>
                </div>
                {{ Form::close() }}
            </div>
        </div>


        <hr>
        <div class="card">
            <div class="card-header bg-primary"><h4 style="color: white;">My Shared Lists</h4></div>
            <div class="card-body">
                <p class="lead">
                    Guide list's which have been created by others and shared with you will appear below.
                </p>


                <table class="table table-hover">
                    <tr>
                        <th>Name</th>
                    </tr>
                    <tr>
                        <td>You currently have no lists shared with you.</td>
                    </tr>
                </table></div>
        </div>


    </div>
@endsection