@extends('layouts.app')

@section('content')
    <div class="container">
        <h4>@lang('category.deleteTitle') "{{ $category->name }}"</h4>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ Route('admin.dashboard') }}">@lang('admin.dashboardtitle')</a></li>
                <li class="breadcrumb-item active" aria-current="page">@lang('category.deleteTitle') "{{ $category->name }}"</li>
            </ol>
        </nav>


        @lang('category.areYouSureDelete')

        {{ Form::open() }}
        {{ Form::submit('Confirm', ['class' => 'btn btn-danger']) }}
        <a href="" class="btn btn-primary">No, take me back!</a>
        {{ Form::close() }}
    </div>
@endsection
