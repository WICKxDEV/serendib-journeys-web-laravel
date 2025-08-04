@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">
                        <i class="fas fa-plus me-2"></i>
                        Add New Review
                    </h4>
                    <a href="{{ route('admin.reviews.index') }}" class="btn btn-outline-secondary btn-sm">
                        <i class="fas fa-arrow-left me-1"></i>
                        Back to Reviews
                    </a>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.reviews.store') }}" method="POST">
                        @csrf
                        
                        <div class="row">
                            <!-- User Selection -->
                            <div class="col-md-6 mb-3">
                                <label for="user_id" class="form-label">
                                    <i class="fas fa-user me-1"></i>
                                    User *
                                </label>
                                <select name="user_id" id="user_id" class="form-select @error('user_id') is-invalid @enderror" required>
                                    <option value="">Select User</option>
                                    @foreach(\App\Models\User::whereHas('roles', function($query) {
                                        $query->where('slug', 'customer');
                                    })->get() as $user)
                                        <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                            {{ $user->name }} ({{ $user->email }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('user_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text">
                                    <i class="fas fa-info-circle me-1"></i>
                                    Select the user who wrote this review.
                                </div>
                            </div>

                            <!-- Tour Selection -->
                            <div class="col-md-6 mb-3">
                                <label for="tour_id" class="form-label">
                                    <i class="fas fa-map-marked-alt me-1"></i>
                                    Tour *
                                </label>
                                <select name="tour_id" id="tour_id" class="form-select @error('tour_id') is-invalid @enderror" required>
                                    <option value="">Select Tour</option>
                                    @foreach(\App\Models\Tour::with('destination')->get() as $tour)
                                        <option value="{{ $tour->id }}" {{ old('tour_id') == $tour->id ? 'selected' : '' }}>
                                            {{ $tour->title }} - {{ $tour->destination->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('tour_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text">
                                    <i class="fas fa-info-circle me-1"></i>
                                    Select the tour being reviewed.
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
                                    <option value="1" {{ old('rating') == 1 ? 'selected' : '' }}>
                                        ⭐ 1 Star - Poor
                                    </option>
                                    <option value="2" {{ old('rating') == 2 ? 'selected' : '' }}>
                                        ⭐⭐ 2 Stars - Fair
                                    </option>
                                    <option value="3" {{ old('rating') == 3 ? 'selected' : '' }}>
                                        ⭐⭐⭐ 3 Stars - Good
                                    </option>
                                    <option value="4" {{ old('rating') == 4 ? 'selected' : '' }}>
                                        ⭐⭐⭐⭐ 4 Stars - Very Good
                                    </option>
                                    <option value="5" {{ old('rating') == 5 ? 'selected' : '' }}>
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
                                <input type="text" value="{{ now()->format('F d, Y \a\t g:i A') }}" 
                                       class="form-control" readonly>
                                <div class="form-text">
                                    <i class="fas fa-info-circle me-1"></i>
                                    This will be set to the current date and time.
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
                                      placeholder="Enter the review comment..." required>{{ old('comment') }}</textarea>
                            @error('comment')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">
                                <i class="fas fa-info-circle me-1"></i>
                                Maximum 1000 characters. Current length: <span id="char-count">0</span>/1000
                            </div>
                        </div>

                        <!-- Rating Preview -->
                        <div class="mb-3">
                            <label class="form-label">
                                <i class="fas fa-eye me-1"></i>
                                Rating Preview
                            </label>
                            <div class="border rounded p-3 bg-light">
                                <div class="d-flex align-items-center mb-2">
                                    <div class="me-3" id="rating-preview">
                                        <i class="fas fa-star text-muted"></i>
                                        <i class="fas fa-star text-muted"></i>
                                        <i class="fas fa-star text-muted"></i>
                                        <i class="fas fa-star text-muted"></i>
                                        <i class="fas fa-star text-muted"></i>
                                    </div>
                                    <span class="badge bg-primary" id="rating-badge">0/5</span>
                                </div>
                                <div class="text-muted">
                                    <small>
                                        <i class="fas fa-info-circle me-1"></i>
                                        Preview of how the rating will appear
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
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-save me-1"></i>
                                Create Review
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
    const ratingPreview = document.getElementById('rating-preview');
    const ratingBadge = document.getElementById('rating-badge');
    
    ratingSelect.addEventListener('change', function() {
        const rating = parseInt(this.value) || 0;
        const stars = ratingPreview.querySelectorAll('.fas.fa-star');
        
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
        ratingBadge.textContent = rating + '/5';
    });
});
</script>
@endsection 