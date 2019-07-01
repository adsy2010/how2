@extends('layouts.app')

@section('content')
    <div class="container">
        <h4>@lang('approvals.viewTitle')</h4>
    @php
        //separating the data from the template
        $breadcrumbs = [
            ['title' => __('admin.dashboardtitle'), 'route' => 'admin.dashboard'],
            ['title' => __('approvals.listTitle'), 'route' => 'admin.approvals.list'],
            ['title' => __('approvals.viewTitle'), 'route' => 'admin.approvals.view']
        ];
    @endphp
    @include('common.errors')
    @include('common.success')
    @include('common.breadcrumb')


        <a href="{{ Route('admin.approvals.list') }}" class="btn btn-primary"><span class="fas fa-eye"></span> Return to list</a>
        <a href="{{ Route('admin.approvals.approve', ['id' => $approval->id]) }}" class="btn btn-primary"><span class="fas fa-check"></span> Approve</a>
        <a href="{{ Route('admin.approvals.reject', ['id' => $approval->id]) }}" class="btn btn-primary"><span class="fas fa-times"></span> Reject</a>
        <hr>
        <div class="jumbotron">
            <h1>{{ $approval->guideInfo->name }}</h1>
            <p>GUIDE DESCRIPTION - may add this later</p>
        </div>


        <hr>
        @lang('guides.categoryLabel'): {{ $approval->guideInfo->categoryInfo->name }}<br>
        @lang('guides.tagLabel'): {{ (!empty($approval->guideInfo->tags)) ? $approval->guideInfo->tags : 'No tags defined for this guide' }}

        <hr>
        <h2>@lang('guides.stepsTitle')</h2>
        <hr>
        @foreach($approval->guideInfo->steps as $step)
            <div class="row steps p-2 m-2 rounded">
                <div class="col-md-2" style="vertical-align: middle; " ><p class="lead">@lang('guides.stepLabel') # {{ $step->stepNumber }}</p></div>
                <div class="col-md-8"><p class="lead" style="font-size: 20px; text-align: justify; ">{{ $step->stepContent }}</p></div>
                <div class="col-md-2">

                    @if(sizeof($step->supplementaryContent) > 0)
                        @if($step->supplementaryContent->pluck('dataType') == '1')
                            video
                        @else
                            <img class="img-thumbnail" src="{{ stripslashes($step->supplementaryContent->pluck('contentLocation')[0]) }}" />
                        @endif

                    @endif

                </div>
            </div>

        @endforeach
        <hr>
        <a href="{{ Route('admin.approvals.list') }}" class="btn btn-primary"><span class="fas fa-eye"></span> Return to list</a>
        <a href="{{ Route('admin.approvals.approve', ['id' => $approval->id]) }}" class="btn btn-primary"><span class="fas fa-check"></span> Approve</a>
        <a href="{{ Route('admin.approvals.reject', ['id' => $approval->id]) }}" class="btn btn-primary"><span class="fas fa-times"></span> Reject</a>
    </div>

@endsection