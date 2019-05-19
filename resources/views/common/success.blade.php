@if (session()->has('success'))
    <!-- Form Error List -->
    <div class="alert alert-success">
        <strong>Success!</strong> -
        {!! session()->get('success') !!}
    </div>
@endif