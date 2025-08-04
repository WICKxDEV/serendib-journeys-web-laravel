@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">
                        <i class="fas fa-edit me-2"></i>
                        Edit Review
                    </h4>
                    <a href="{{ route('admin.reviews.index') }}" class="btn btn-outline-secondary btn-sm">
                        <i class="fas fa-arrow-left me-1"></i>
                        Back to Reviews
                    </a>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.reviews.update', $review) }}" method="POST">
                        @csrf 
                        @method('PUT')
                        
                        <!-- Review Information Display -->
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

                        <div class="row">
                            <!-- Rating -->
                            <div class="col-md-6 mb-3">
                                <label for="rating" class="form-label">
                                    <i class="fas fa-star me-1"></i>
                                    Rating *
                                </label>
                                <select name="rating" id="rating" class="form-select @error('rating') is-invalid @enderror" required>
                                    <option value="">Select Rating</option>
                                    <option value="1" {{ old('rating', $review->rating) == 1 ? 'selected' : '' }}>
                                        ⭐ 1 Star - Poor
                                    </option>
                                    <option value="2" {{ old('rating', $review->rating) == 2 ? 'selected' : '' }}>
                                        ⭐⭐ 2 Stars - Fair
                                    </option>
                                    <option value="3" {{ old('rating', $review->rating) == 3 ? 'selected' : '' }}>
                                        ⭐⭐⭐ 3 Stars - Good
                                    </option>
                                    <option value="4" {{ old('rating', $review->rating) == 4 ? 'selected' : '' }}>
                                        ⭐⭐⭐⭐ 4 Stars - Very Good
                                    </option>
                                    <option value="5" {{ old('rating', $review->rating) == 5 ? 'selected' : '' }}>
                                        ⭐⭐⭐⭐⭐ 5 Stars - Excellent
                                    </option>
                                </select>
                                @error('rating')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text">
                                    <i class="fas fa-info-circle me-1"></i>
                                    Select the appropriate rating for this review.
                                </div>
                            </div>

                            <!-- Review Date -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label">
                                    <i class="fas fa-calendar me-1"></i>
                                    Review Date
                                </label>
                                <input type="text" value="{{ $review->created_at->format('F d, Y \a\t g:i A') }}" 
                                       class="form-control" readonly>
                                <div class="form-text">
                                    <i class="fas fa-info-circle me-1"></i>
                                    This is when the review was originally posted.
                                </div>
                            </div>
                        </div>

                        <!-- Comment -->
                        <div class="mb-3">
                            <label for="comment" class="form-label">
                                <i class="fas fa-comment me-1"></i>
                                Review Comment *
                            </label>
                            <textarea name="comment" id="comment" rows="6" 
                                      class="form-control @error('comment') is-invalid @enderror" 
                                      placeholder="Enter the review comment..." required>{{ old('comment', $review->comment) }}</textarea>
                            @error('comment')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">
                                <i class="fas fa-info-circle me-1"></i>
                                Maximum 1000 characters. Current length: <span id="char-count">{{ strlen($review->comment) }}</span>/1000
                            </div>
                        </div>

                        <!-- Current Rating Display -->
                        <div class="mb-3">
                            <label class="form-label">
                                <i class="fas fa-star me-1"></i>
                                Current Rating Display
                            </label>
                            <div class="border rounded p-3 bg-light">
                                <div class="d-flex align-items-center mb-2">
                                    <div class="me-3">
                                        @for($i = 1; $i <= 5; $i++)
                                            <i class="fas fa-star {{ $i <= $review->rating ? 'text-warning' : 'text-muted' }}"></i>
                                        @endfor
                                    </div>
                                    <span class="badge bg-primary">{{ $review->rating }}/5</span>
                                </div>
                                <div class="text-muted">
                                    <small>
                                        <i class="fas fa-user me-1"></i>
                                        {{ $review->user->name }} • 
                                        <i class="fas fa-map-marked-alt me-1"></i>
                                        {{ $review->tour->title }}
                                    </small>
                                </div>
                            </div>
                        </div>

                        <!-- Form Actions -->
                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('admin.reviews.index') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-times me-1"></i>
                                Cancel
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-1"></i>
                                Update Review
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Character counter for comment
document.addEventListener('DOMContentLoaded', function() {
    const commentTextarea = document.getElementById('comment');
    const charCount = document.getElementById('char-count');
    
    commentTextarea.addEventListener('input', function() {
        const length = this.value.length;
        charCount.textContent = length;
        
        if (length > 1000) {
            charCount.classList.add('text-danger');
            charCount.classList.remove('text-muted');
        } else {
            charCount.classList.remove('text-danger');
            charCount.classList.add('text-muted');
        }
    });
    
    // Initialize character count
    charCount.textContent = commentTextarea.value.length;
});

// Rating preview
document.addEventListener('DOMContentLoaded', function() {
    const ratingSelect = document.getElementById('rating');
    const ratingDisplay = document.querySelector('.border.rounded.p-3.bg-light .d-flex .me-3');
    
    ratingSelect.addEventListener('change', function() {
        const rating = parseInt(this.value);
        const stars = ratingDisplay.querySelectorAll('.fas.fa-star');
        
        stars.forEach((star, index) => {
            if (index < rating) {
                star.classList.add('text-warning');
                star.classList.remove('text-muted');
            } else {
                star.classList.remove('text-warning');
                star.classList.add('text-muted');
            }
        });
        
        // Update badge
        const badge = ratingDisplay.nextElementSibling;
        badge.textContent = rating + '/5';
    });
});
</script>
@endsection 