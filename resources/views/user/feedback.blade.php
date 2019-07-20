@extends('layouts.app')

@section('content')
    <div class="container">
        <h4>My Feedback</h4>
    @php
        //separating the data from the template
        $breadcrumbs = [
            ['title' => __('generic.home'), 'route' => 'root'],
            ['title' => 'My Feedback', 'route' => '']
        ];
    @endphp
    @include('common.errors')
    @include('common.success')
    @include('common.breadcrumb')


        <h4>Feedback received</h4>
        <table class="table table-striped">
            <tr>
                <th>Guide</th>
                <th>Message</th>
                <th>Posted at</th>
            </tr>
            @foreach($received->pluck('feedback') as $f)
                <tr>
                    <td>{{ $f->pluck('guideInfo')->pluck('name')->first() }}</td>
                    <td>{{ $f->pluck('comment')->first() }}</td>
                    <td>{{ $f->pluck('created_at')->first() }}</td>
                </tr>
            @endforeach

        </table>
        {{ $received->links() }}
        <hr>
        <h4>Feedback given</h4>
        <table class="table table-striped">
            <tr>
                <th>Guide</th>
                <th>Message</th>
                <th>Posted at</th>
            </tr>
            @foreach($feedback as $f)
                <tr>
                    <td>{{ $f->guideInfo->name }}</td>
                    <td>{{ $f->comment }}</td>
                    <td>{{ $f->created_at }}</td>
                </tr>
            @endforeach
        </table>
        {{ $feedback->links() }}
    </div>
@endsection