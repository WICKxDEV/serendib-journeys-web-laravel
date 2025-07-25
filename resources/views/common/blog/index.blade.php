@extends('layouts.app')

@section('title', 'Our Blog')

@section('content')
<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h6 class="section-title bg-white text-center text-primary px-3">Blog</h6>
            <h1 class="mb-5">Read Our Latest Articles</h1>
        </div>
        <div class="row g-4 justify-content-center">
            @forelse ($blogs as $blog)
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="package-item">
                        <div class="overflow-hidden">
                            <img class="img-fluid" src="{{ asset('storage/' . $blog->featured_image) }}" alt="{{ $blog->title }}" style="width: 100%; height: 250px; object-fit: cover;">
                        </div>
                        <div class="d-flex border-bottom">
                            <small class="flex-fill text-center border-end py-2"><i class="fa fa-user-tie text-primary me-2"></i>{{ $blog->author->name }}</small>
                            <small class="flex-fill text-center py-2"><i class="fa fa-calendar-alt text-primary me-2"></i>{{ $blog->created_at->format('d M, Y') }}</small>
                        </div>
                        <div class="p-4">
                            <h5 class="mb-3">{{ Str::limit($blog->title, 50) }}</h5>
                            <p>{{ Str::limit(strip_tags($blog->content), 100) }}</p>
                            <div class="d-flex justify-content-center mb-2">
                                <a href="{{ route('blog.show', $blog->slug) }}" class="btn btn-sm btn-primary px-3" style="border-radius: 30px;">Read More</a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center">
                    <p>No blog posts found.</p>
                </div>
            @endforelse
        </div>

        <div class="d-flex justify-content-center mt-5">
            {{ $blogs->links() }}
        </div>
    </div>
</div>
@endsection
