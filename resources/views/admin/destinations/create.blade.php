@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">
                        <i class="fas fa-plus me-2"></i>
                        Add New Destination
                    </h4>
                    <a href="{{ route('admin.destinations.index') }}" class="btn btn-outline-secondary btn-sm">
                        <i class="fas fa-arrow-left me-1"></i>
                        Back to Destinations
                    </a>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.destinations.store') }}" method="POST">
                        @csrf
                        
                        <div class="row">
                            <!-- Destination Name -->
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label">
                                    <i class="fas fa-map-marker-alt me-1"></i>
                                    Destination Name *
                                </label>
                                <input type="text" name="name" id="name" 
                                       value="{{ old('name') }}" 
                                       class="form-control @error('name') is-invalid @enderror" 
                                       placeholder="Enter destination name" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Location -->
                            <div class="col-md-6 mb-3">
                                <label for="location" class="form-label">
                                    <i class="fas fa-map-pin me-1"></i>
                                    Location *
                                </label>
                                <input type="text" name="location" id="location" 
                                       value="{{ old('location') }}" 
                                       class="form-control @error('location') is-invalid @enderror" 
                                       placeholder="Enter location (e.g., Colombo, Sri Lanka)" required>
                                @error('location')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="mb-3">
                            <label for="description" class="form-label">
                                <i class="fas fa-align-left me-1"></i>
                                Description *
                            </label>
                            <textarea name="description" id="description" rows="4" 
                                      class="form-control @error('description') is-invalid @enderror" 
                                      placeholder="Enter detailed description of the destination..." required>{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">
                                <i class="fas fa-info-circle me-1"></i>
                                Provide a compelling description that will attract tourists.
                            </div>
                        </div>

                        <div class="row">
                            <!-- Category -->
                            <div class="col-md-6 mb-3">
                                <label for="category" class="form-label">
                                    <i class="fas fa-tags me-1"></i>
                                    Category *
                                </label>
                                <select name="category" id="category" class="form-select @error('category') is-invalid @enderror" required>
                                    <option value="">Select Category</option>
                                    <option value="Beach" {{ old('category') == 'Beach' ? 'selected' : '' }}>Beach</option>
                                    <option value="Mountain" {{ old('category') == 'Mountain' ? 'selected' : '' }}>Mountain</option>
                                    <option value="Cultural" {{ old('category') == 'Cultural' ? 'selected' : '' }}>Cultural</option>
                                    <option value="Wildlife" {{ old('category') == 'Wildlife' ? 'selected' : '' }}>Wildlife</option>
                                    <option value="City" {{ old('category') == 'City' ? 'selected' : '' }}>City</option>
                                    <option value="Historical" {{ old('category') == 'Historical' ? 'selected' : '' }}>Historical</option>
                                    <option value="Adventure" {{ old('category') == 'Adventure' ? 'selected' : '' }}>Adventure</option>
                                    <option value="Religious" {{ old('category') == 'Religious' ? 'selected' : '' }}>Religious</option>
                                </select>
                                @error('category')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Image URL -->
                            <div class="col-md-6 mb-3">
                                <label for="image_url" class="form-label">
                                    <i class="fas fa-image me-1"></i>
                                    Image URL *
                                </label>
                                <input type="url" name="image_url" id="image_url" 
                                       value="{{ old('image_url') }}" 
                                       class="form-control @error('image_url') is-invalid @enderror" 
                                       placeholder="https://example.com/image.jpg" required>
                                @error('image_url')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text">
                                    <i class="fas fa-info-circle me-1"></i>
                                    Enter a valid image URL (JPG, PNG, or WebP format recommended).
                                </div>
                            </div>
                        </div>

                        <!-- Form Actions -->
                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('admin.destinations.index') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-times me-1"></i>
                                Cancel
                            </a>
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-save me-1"></i>
                                Create Destination
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Add image URL validation
document.addEventListener('DOMContentLoaded', function() {
    const imageUrlInput = document.getElementById('image_url');
    
    imageUrlInput.addEventListener('blur', function() {
        const url = this.value;
        if (url && !isValidImageUrl(url)) {
            this.classList.add('is-invalid');
            if (!this.nextElementSibling || !this.nextElementSibling.classList.contains('invalid-feedback')) {
                const feedback = document.createElement('div');
                feedback.className = 'invalid-feedback';
                feedback.textContent = 'Please enter a valid image URL';
                this.parentNode.appendChild(feedback);
            }
        } else {
            this.classList.remove('is-invalid');
            const feedback = this.parentNode.querySelector('.invalid-feedback');
            if (feedback && feedback.textContent === 'Please enter a valid image URL') {
                feedback.remove();
            }
        }
    });
    
    function isValidImageUrl(url) {
        try {
            const urlObj = new URL(url);
            const extension = urlObj.pathname.split('.').pop().toLowerCase();
            return ['jpg', 'jpeg', 'png', 'gif', 'webp'].includes(extension);
        } catch {
            return false;
        }
    }
});
</script>
@endsection
