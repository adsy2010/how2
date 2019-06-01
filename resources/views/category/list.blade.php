@extends('layouts.app')

@section('content')
    <div class="container">
        <h4>@lang('category.listTitle')</h4>
        @php
            //separating the data from the template
            $breadcrumbs = [
                ['title' => __('admin.dashboardtitle'), 'route' => 'admin.dashboard'],
                ['title' => __('category.listTitle'), 'route' => 'category.list']
            ];
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
                <th width="180">Actions</th>
            </tr>
            @if(count($categories) < 1)
                <tr>
                    <td colspan="4">No subcategories</td>
                </tr>
            @endif
            @foreach($categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td><a href="{{ Route('category.list.children', $category->id) }}">{{ $category->name }}</a></td>
                    <td>
                        @if($category->parent == null)
                            None
                        @else
                            @if($category->parentInfo->parent == null)
                                <a href="{{ Route('category.list') }}">{{ $category->parentInfo->name }}
                            @else
                                <a href="{{ Route('category.list.children', $category->id) }}">{{ $category->parentInfo->name }}</a>
                            @endif
                        @endif
                    </td>
                    <td>
                        <a href="{{ Route('admin.category.edit', ['id' => $category->id]) }}" class="btn btn-primary">
                            <span class="fa fa-edit"></span>
                        </a>
                        <a href="{{ Route('admin.category.delete', ['id' => $category->id]) }}" class="btn btn-danger">
                            <span class="fa fa-trash"></span>
                        </a>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection
