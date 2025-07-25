@extends('layouts.app')

@section('title', $blog->title)

@section('content')
<div class="container-xxl py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <div class="wow fadeInUp" data-wow-delay="0.1s">
                    <h1 class="mb-4">{{ $blog->title }}</h1>
                    <div class="d-flex align-items-center mb-4">
                        <small class="me-3"><i class="fa fa-user-tie text-primary me-2"></i>{{ $blog->author->name }}</small>
                        <small><i class="fa fa-calendar-alt text-primary me-2"></i>{{ $blog->created_at->format('d M, Y') }}</small>
                    </div>

                    @if($blog->featured_image)
                        <img class="img-fluid w-100 mb-4" src="{{ asset('storage/' . $blog->featured_image) }}" alt="{{ $blog->title }}">
                    @endif

                    <div class="blog-content">
                        {!! $blog->content !!}
                    </div>

                    <div class="mt-5">
                        <a href="{{ route('blog.index') }}" class="btn btn-primary">&larr; Back to Blog</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 