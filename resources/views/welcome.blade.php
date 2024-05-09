@extends('layouts.app')
@section('content')


<div class="container my-4">
    <h1 class="text-center">Blogs</h1>

    <div class="row">
        @foreach ($blogs as $blog)
            <div class="col-sm-4">
                <div class="card shadow">
                    <div class="card-body">
                        <div class="image mb-2">
                            <img src="/storage/{{ $blog->image }}" alt="{{ $blog->title }}" class="img-fluid rounded">
                        </div>

                        <h3 class="h5 mb-3"><a href="{{ route('blog.single', $blog->slug) }}">{{ $blog->title }}</a></h3>
                        <p class="small">{{ $blog->excerpt }}</p>

                        <a href="{{ route('blog.single', $blog->slug) }}" class="btn btn-primary btn-sm">Read More <i class="bi bi-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        @endforeach


    </div>
</div>

@endsection
