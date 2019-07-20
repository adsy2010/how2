@extends('layouts.app')

@section('content')
    <div class="container">
        <h4>@lang('category.listTitle')</h4>
        @php
            //separating the data from the template
            $breadcrumbs[] = ['title' => __('admin.dashboardtitle'), 'route' => 'admin.dashboard'];
            $breadcrumbs[] = ['title' => __('category.listTitle'), 'route' => 'admin.category.list'];
            if(isset($category->parentInfo)) $breadcrumbs[] = ['title' => $category->parentInfo->name, 'route' => 'admin.category.list.children','routedata' => $category->parentInfo->id];

        if(!empty($category))
            $breadcrumbs[] = ['title' => $category->name, 'route' => ''];
        @endphp
        @include('common.errors')
        @include('common.success')
        @include('common.breadcrumb')

        @if(Route::getCurrentRoute()->getName() != 'admin.category.list')
            <a class="btn btn-light" href="{{ Route('admin.category.list') }}">Top level</a>
        @endif
        <div class="row">
            <div class="col-12 m-2">
                <a class="btn btn-light" href="{{ URL::previous()  }}">Back a page</a>
                <a class="btn btn-primary float-right" href="{{ Route('admin.category.add')  }}">Add category</a>
            </div>
        </div>


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
            @foreach($categories as $cat)
                <tr>
                    <td>{{ $cat->id }}</td>
                    <td><a href="{{ Route('admin.category.list.children', $cat->id) }}">{{ $cat->name }}</a></td>
                    <td>
                        @if($cat->parent == null)
                            None
                        @else
                            @if($cat->parentInfo->parent == null)
                                <a href="{{ Route('admin.category.list') }}">{{ $cat->parentInfo->name }}</a>
                            @else
                                <a href="{{ Route('admin.category.list.children', $cat->id) }}">{{ $cat->parentInfo->name }}</a>
                            @endif
                        @endif
                    </td>
                    <td>
                        <a href="{{ Route('admin.category.edit', ['id' => $cat->id]) }}" class="btn btn-primary">
                            <span class="fa fa-edit"></span>
                        </a>
                        <a href="{{ Route('admin.category.delete', ['id' => $cat->id]) }}" class="btn btn-danger">
                            <span class="fa fa-trash"></span>
                        </a>
                    </td>
                </tr>
            @endforeach

        </table>
        {{ $categories->links() }}


    </div>
@endsection