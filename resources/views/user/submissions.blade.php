@extends('layouts.app')

@section('content')
    <div class="container">
        <h4>My submissions</h4>
    @php
        //separating the data from the template
        $breadcrumbs = [
            ['title' => 'My Dashboard', 'route' => 'home'],
            ['title' => 'My Submissions', 'route' => '']
        ];
    @endphp
    @include('common.errors')
    @include('common.success')
    @include('common.breadcrumb')

        <h5>Drafts</h5>
        <table class="table table-hover">
            <tr>
                <th>#</th>
                <th>Guide</th>
                <th>Tags</th>
                <th width="200">Actions</th>
            </tr>
            @foreach($drafts as $submission)
                <tr>
                    <td>{{ $submission->id }}</td>
                    <td>{{ $submission->name }}</td>
                    <td>{{ $submission->tags }}</td>
                    <td></td>
                </tr>
            @endforeach
        </table>
        {{ $drafts->appends(['published' => $published->currentPage()])->links() }}

        <h5>Approved Submissions</h5>
        <table class="table table-hover">
            <tr>
                <th>#</th>
                <th>Guide</th>
                <th>Tags</th>
                <th>Published</th>
                <th width="200">Actions</th>
            </tr>
            @foreach($published as $submission)
                <tr>
                    <td>{{ $submission->id }}</td>
                    <td>{{ $submission->name }}</td>
                    <td>{{ $submission->tags }}</td>
                    <td>{{ $submission->publishedTimestamp }}</td>
                    <td></td>
                </tr>
            @endforeach
        </table>

        {{ $published->appends(['drafts' => $drafts->currentPage()])->links() }}

    </div>
@endsection