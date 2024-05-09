@extends('layouts.app')
@section('content')
{{-- @dd($blog) --}}

<div class="container my-4">
    <div class="row">
        <div class="col-sm-9">
            <div class="image mb-2">
                <img src="/storage/{{ $blog->image }}" alt="{{ $blog->title }}" class="img-fluid rounded">
            </div>

            <h1 class="h3 mb-2">{{ $blog->title }}</h1>

            {!! $blog->content !!}
        </div>

        <div class="col-sm-3"></div>
    </div>
</div>

@endsection
