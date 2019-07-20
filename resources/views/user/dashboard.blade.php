@extends('layouts.app')

@section('content')
<div class="container">
    <h2>My dashboard</h2>
    <hr>
    @include('common.errors')
    @include('common.success')
    <div class="jumbotron">
        <p class="lead">Select an option from below to explore content you have connected with.</p>
    </div>
    <div class="row">
        <div class="col-md-4 col-sm-6" style="margin-bottom: 5px;"><a href="{{ Route('user.submissions') }}" class="btn btn-primary btn-dashboard">My submissions</a></div>
        <div class="col-md-4 col-sm-6" style="margin-bottom: 5px;"><a href="{{ Route('user.feedback') }}" class="btn btn-primary btn-dashboard">My feedback</a></div>
        <div class="col-md-4 col-sm-6" style="margin-bottom: 5px;"><a href="{{ Route('guides.user', ['id'=> Auth::id()]) }}" class="btn btn-primary btn-dashboard">My Latest Guides</a></div>
    </div>
</div>
@endsection
