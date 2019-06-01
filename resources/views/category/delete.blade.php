@extends('layouts.app')

@section('content')
    <div class="container">
        <h4>@lang('category.deleteTitle')</h4>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ Route('admin.dashboard') }}">@lang('admin.dashboardtitle')</a></li>
                <li class="breadcrumb-item active" aria-current="page">@lang('category.deleteTitle')</li>
            </ol>
        </nav>
    </div>
@endsection
