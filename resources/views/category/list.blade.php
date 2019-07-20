@extends('layouts.app')

@section('content')
    <div class="container">
        <h4>@lang('category.listTitle')</h4>
        @php
            //separating the data from the template
            $breadcrumbs[] = ['title' => __('generic.home'), 'route' => 'root'];
            $breadcrumbs[] = ['title' => __('category.listTitle'), 'route' => 'category.list'];
            if(isset($category->parentInfo)) $breadcrumbs[] = ['title' => $category->parentInfo->name, 'route' => 'category.list.children','routedata' => $category->parentInfo->id];

        if(!empty($category))
            $breadcrumbs[] = ['title' => $category->name, 'route' => ''];
        @endphp
        @include('common.errors')
        @include('common.success')
        @include('common.breadcrumb')

        @if(Route::getCurrentRoute()->getName() != 'category.list')
            <a class="btn btn-light" href="{{ Route('category.list') }}">Top level</a>
        @endif
        <a class="btn btn-light" href="{{ URL::previous()  }}">Back a page</a>

        <table class="table table-hover">
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Parent</th>
            </tr>
            @if(count($categories) < 1)
                <tr>
                    <td colspan="4">No subcategories</td>
                </tr>
            @endif
            @foreach($categories as $cat)
                <tr>
                    <td>{{ $cat->id }}</td>
                    <td><a href="{{ Route('category.list.children', $cat->id) }}">{{ $cat->name }}</a></td>
                    <td>
                        @if($cat->parent == null)
                            None
                        @else
                            @if($cat->parentInfo->parent == null)
                                <a href="{{ Route('category.list') }}">{{ $cat->parentInfo->name }}</a>
                            @else
                                <a href="{{ Route('category.list.children', $cat->id) }}">{{ $cat->parentInfo->name }}</a>
                            @endif
                        @endif
                    </td>
                </tr>
            @endforeach

        </table>
        {{ $categories->links() }}

        <hr>
        @if(request('id'))
            <h4>Guides</h4>
        <div class="row">
            @if(!(count($catguides = $category->guides()->where('published', 1)->orderBy('publishedTimestamp', 'DESC')->get()) > 0))
                There are no guides at this level
            @endif
            @foreach($catguides as $guide)
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div data-href="{{ Route('guide.view', ['id' => $guide->id]) }}" class="card clickable-row list-guide-item m-2 rounded" style="height: 240px;">
                        <div class="card-header bg-info">
                            <p class="lead" style="font-size: 20px;">{{ $guide->name }}</p>
                        </div>
                        <div class="card-body">
                            {{ $guide->steps->count() }} {{ Str::plural('step', $guide->steps->count()) }}<br>
                            @php
                                $ratings = $guide->helpful + $guide->unhelpful;
                                $helpful = ($ratings > 0 && $guide->helpful > 0)     ? round(($guide->helpful / $ratings) * 100) : 0;
                                $unhelpful = ($ratings > 0 && $guide->unhelpful > 0) ? round(($guide->unhelpful / $ratings) * 100) : 0;
                            @endphp
                            <div class="progress m-2">
                                <div id='helpfulbar' class="progress-bar bg-success" role="progressbar" style="width: {{ $helpful }}%" aria-valuenow="{{ $guide->helpful }}" aria-valuemin="0" aria-valuemax="{{ $ratings }}"></div>
                                <div id='unhelpfulbar' class="progress-bar bg-danger" role="progressbar" style="width: {{ $unhelpful }}%" aria-valuenow="{{ $guide->unhelpful }}" aria-valuemin="0" aria-valuemax="{{ $ratings }}"></div>
                            </div>
                        </div>
                        <div class="card-footer" style="height: 40px;"><p class="small">Published: {{ Carbon\Carbon::parse($guide->publishedTimestamp)->isoFormat('ll') }} at {{ Carbon\Carbon::parse($guide->publishedTimestamp)->isoFormat('LT') }}</p></div>
                    </div>
                </div>
            @endforeach
        </div>
        @endif

    </div>
@endsection
