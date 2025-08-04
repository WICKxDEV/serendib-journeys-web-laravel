@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">
                        <i class="fas fa-plus me-2"></i>
                        Add New Tour
                    </h4>
                    <a href="{{ route('admin.tours.index') }}" class="btn btn-outline-secondary btn-sm">
                        <i class="fas fa-arrow-left me-1"></i>
                        Back to Tours
                    </a>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.tours.store') }}" method="POST">
                        @csrf
                        
                        <div class="row">
                            <!-- Destination Selection -->
                            <div class="col-md-6 mb-3">
                                <label for="destination_id" class="form-label">
                                    <i class="fas fa-map-marker-alt me-1"></i>
                                    Destination *
                                </label>
                                <select name="destination_id" id="destination_id" class="form-select @error('destination_id') is-invalid @enderror" required>
                                    <option value="">Select Destination</option>
                                    @foreach($destinations as $destination)
                                        <option value="{{ $destination->id }}" {{ old('destination_id') == $destination->id ? 'selected' : '' }}>
                                            {{ $destination->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('destination_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Tour Title -->
                            <div class="col-md-6 mb-3">
                                <label for="title" class="form-label">
                                    <i class="fas fa-heading me-1"></i>
                                    Tour Title *
                                </label>
                                <input type="text" name="title" id="title" value="{{ old('title') }}" 
                                       class="form-control @error('title') is-invalid @enderror" 
                                       placeholder="Enter tour title" required>
                                @error('title')
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
                                      placeholder="Enter tour description..." required>{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <!-- Price -->
                            <div class="col-md-4 mb-3">
                                <label for="price" class="form-label">
                                    <i class="fas fa-dollar-sign me-1"></i>
                                    Price (USD) *
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text">$</span>
                                    <input type="number" step="0.01" name="price" id="price" 
                                           value="{{ old('price') }}" 
                                           class="form-control @error('price') is-invalid @enderror" 
                                           placeholder="0.00" required>
                                </div>
                                @error('price')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Available From -->
                            <div class="col-md-4 mb-3">
                                <label for="available_from" class="form-label">
                                    <i class="fas fa-calendar-plus me-1"></i>
                                    Available From *
                                </label>
                                <input type="date" name="available_from" id="available_from" 
                                       value="{{ old('available_from') }}" 
                                       class="form-control @error('available_from') is-invalid @enderror" required>
                                @error('available_from')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Available To -->
                            <div class="col-md-4 mb-3">
                                <label for="available_to" class="form-label">
                                    <i class="fas fa-calendar-minus me-1"></i>
                                    Available To *
                                </label>
                                <input type="date" name="available_to" id="available_to" 
                                       value="{{ old('available_to') }}" 
                                       class="form-control @error('available_to') is-invalid @enderror" required>
                                @error('available_to')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Itinerary -->
                        <div class="mb-3">
                            <label for="itinerary" class="form-label">
                                <i class="fas fa-route me-1"></i>
                                Itinerary *
                            </label>
                            <textarea name="itinerary" id="itinerary" rows="6" 
                                      class="form-control @error('itinerary') is-invalid @enderror" 
                                      placeholder="Enter detailed itinerary for the tour..." required>{{ old('itinerary') }}</textarea>
                            @error('itinerary')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">
                                <i class="fas fa-info-circle me-1"></i>
                                Provide a detailed day-by-day itinerary for the tour.
                            </div>
                        </div>

                        <!-- Form Actions -->
                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('admin.tours.index') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-times me-1"></i>
                                Cancel
                            </a>
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-save me-1"></i>
                                Create Tour
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Add client-side validation for date range
document.addEventListener('DOMContentLoaded', function() {
    const availableFrom = document.getElementById('available_from');
    const availableTo = document.getElementById('available_to');
    
    availableFrom.addEventListener('change', function() {
        availableTo.min = this.value;
    });
    
    availableTo.addEventListener('change', function() {
        if (availableFrom.value && this.value < availableFrom.value) {
            alert('Available To date must be after Available From date');
            this.value = '';
        }
    });
});
</script>
@endsection
