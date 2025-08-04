@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">
                        <i class="fas fa-eye me-2"></i>
                        Review Details
                    </h4>
                    <div>
                        <a href="{{ route('admin.reviews.edit', $review) }}" class="btn btn-outline-warning btn-sm me-2">
                            <i class="fas fa-edit me-1"></i>
                            Edit Review
                        </a>
                        <a href="{{ route('admin.reviews.index') }}" class="btn btn-outline-secondary btn-sm">
                            <i class="fas fa-arrow-left me-1"></i>
                            Back to Reviews
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Review Information -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="card bg-light">
                                <div class="card-body">
                                    <h6 class="card-title">
                                        <i class="fas fa-user me-1"></i>
                                        User Information
                                    </h6>
                                    <p class="mb-1"><strong>Name:</strong> {{ $review->user->name }}</p>
                                    <p class="mb-1"><strong>Email:</strong> {{ $review->user->email }}</p>
                                    <p class="mb-0"><strong>User ID:</strong> {{ $review->user_id }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card bg-light">
                                <div class="card-body">
                                    <h6 class="card-title">
                                        <i class="fas fa-map-marked-alt me-1"></i>
                                        Tour Information
                                    </h6>
                                    <p class="mb-1"><strong>Tour:</strong> {{ $review->tour->title }}</p>
                                    <p class="mb-1"><strong>Destination:</strong> {{ $review->tour->destination->name }}</p>
                                    <p class="mb-0"><strong>Tour ID:</strong> {{ $review->tour_id }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Rating Display -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <h6 class="card-title">
                                        <i class="fas fa-star me-1"></i>
                                        Rating
                                    </h6>
                                    <div class="d-flex align-items-center mb-2">
                                        <div class="me-3">
                                            @for($i = 1; $i <= 5; $i++)
                                                <i class="fas fa-star {{ $i <= $review->rating ? 'text-warning' : 'text-muted' }} fs-4"></i>
                                            @endfor
                                        </div>
                                        <span class="badge bg-primary fs-6">{{ $review->rating }}/5</span>
                                    </div>
                                    <p class="mb-0 text-muted">
                                        @switch($review->rating)
                                            @case(1)
                                                Poor - Not recommended
                                                @break
                                            @case(2)
                                                Fair - Below average
                                                @break
                                            @case(3)
                                                Good - Average experience
                                                @break
                                            @case(4)
                                                Very Good - Above average
                                                @break
                                            @case(5)
                                                Excellent - Highly recommended
                                                @break
                                        @endswitch
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <h6 class="card-title">
                                        <i class="fas fa-calendar me-1"></i>
                                        Review Information
                                    </h6>
                                    <p class="mb-1"><strong>Posted:</strong> {{ $review->created_at->format('F d, Y \a\t g:i A') }}</p>
                                    <p class="mb-1"><strong>Last Updated:</strong> {{ $review->updated_at->format('F d, Y \a\t g:i A') }}</p>
                                    <p class="mb-0"><strong>Review ID:</strong> {{ $review->id }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Comment -->
                    <div class="card">
                        <div class="card-header">
                            <h6 class="mb-0">
                                <i class="fas fa-comment me-1"></i>
                                Review Comment
                            </h6>
                        </div>
                        <div class="card-body">
                            <div class="border rounded p-3 bg-light">
                                <p class="mb-0">{{ $review->comment }}</p>
                            </div>
                            <div class="mt-2">
                                <small class="text-muted">
                                    <i class="fas fa-info-circle me-1"></i>
                                    Character count: {{ strlen($review->comment) }}/1000
                                </small>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="d-flex justify-content-between mt-4">
                        <div>
                            <form action="{{ route('admin.reviews.destroy', $review) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger" 
                                        onclick="return confirm('Are you sure you want to delete this review? This action cannot be undone.')">
                                    <i class="fas fa-trash me-1"></i>
                                    Delete Review
                                </button>
                            </form>
                        </div>
                        <div>
                            <a href="{{ route('admin.reviews.edit', $review) }}" class="btn btn-warning">
                                <i class="fas fa-edit me-1"></i>
                                Edit Review
                            </a>
                            <a href="{{ route('admin.reviews.index') }}" class="btn btn-secondary">
                                <i class="fas fa-list me-1"></i>
                                Back to List
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 