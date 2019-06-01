@if (count($breadcrumbs) > 0)
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">

            @php($i = 0)
            @foreach ($breadcrumbs as $breadcrumb)
                @if(++$i === sizeof($breadcrumbs))
                    <li class="breadcrumb-item active" aria-current="page">{{ $breadcrumb['title'] }}</li>
                @else
                    <li class="breadcrumb-item"><a href="{{ Route($breadcrumb['route']) }}">{{ $breadcrumb['title'] }}</a></li>
                @endif
            @endforeach
        </ol>
    </nav>
@endif