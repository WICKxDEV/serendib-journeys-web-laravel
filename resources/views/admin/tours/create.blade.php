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
                    <form action="{{ route('admin.tours.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="row">
                            <!-- Primary Destination Selection -->
                            <div class="col-md-6 mb-3">
                                <label for="destination_id" class="form-label">
                                    <i class="fas fa-map-marker-alt me-1"></i>
                                    Primary Destination *
                                </label>
                                <select name="destination_id" id="destination_id" class="form-select @error('destination_id') is-invalid @enderror" required>
                                    <option value="">Select Primary Destination</option>
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

                        <!-- Additional Destinations -->
                        <div class="mb-3">
                            <label class="form-label">
                                <i class="fas fa-map-marked-alt me-1"></i>
                                Additional Destinations
                            </label>
                            <div class="card">
                                <div class="card-body">
                                    <div id="destinations-container">
                                        <div class="row mb-2">
                                            @foreach($destinations as $destination)
                                            <div class="col-md-3 mb-2">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" 
                                                           name="additional_destinations[]" 
                                                           value="{{ $destination->id }}" 
                                                           id="dest_{{ $destination->id }}">
                                                    <label class="form-check-label" for="dest_{{ $destination->id }}">
                                                        {{ $destination->name }}
                                                    </label>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <small class="text-muted">Select additional destinations for this tour package</small>
                                </div>
                            </div>
                        </div>

                        <!-- Tour Activities -->
                        <div class="mb-3">
                            <label class="form-label">
                                <i class="fas fa-hiking me-1"></i>
                                Tour Activities
                            </label>
                            <div class="card">
                                <div class="card-body">
                                    <div id="activities-container">
                                        @if($activities->count() > 0)
                                            <div class="row">
                                                @foreach($activities as $activity)
                                                <div class="col-md-4 mb-3">
                                                    <div class="card border-light">
                                                        <div class="card-body p-3">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" 
                                                                       name="selected_activities[]" 
                                                                       value="{{ $activity->id }}" 
                                                                       id="activity_{{ $activity->id }}">
                                                                <label class="form-check-label" for="activity_{{ $activity->id }}">
                                                                    <strong>{{ $activity->name }}</strong>
                                                                </label>
                                                            </div>
                                                            @if($activity->description)
                                                            <small class="text-muted d-block mt-1">{{ Str::limit($activity->description, 60) }}</small>
                                                            @endif
                                                            @if($activity->duration)
                                                            <small class="text-info d-block">Duration: {{ $activity->duration }}</small>
                                                            @endif
                                                            @if($activity->price)
                                                            <small class="text-success d-block">Price: ${{ number_format($activity->price, 2) }}</small>
                                                            @endif
                                                            <div class="mt-2">
                                                                <label class="form-label small">Day:</label>
                                                                <input type="number" name="activity_day[{{ $activity->id }}]" 
                                                                       class="form-control form-control-sm" 
                                                                       value="1" min="1" max="30" 
                                                                       style="width: 70px; display: inline-block;">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endforeach
                                            </div>
                                        @else
                                            <p class="text-muted">No activities available. <a href="{{ route('admin.activities.create') }}">Create activities first</a>.</p>
                                        @endif
                                    </div>
                                    <small class="text-muted">Select activities that will be included in this tour</small>
                                </div>
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

                        <!-- Tour Images -->
                        <div class="mb-3">
                            <label for="images" class="form-label">
                                <i class="fas fa-images me-1"></i>
                                Tour Images
                            </label>
                            <input type="file" name="images[]" id="images" 
                                   class="form-control @error('images.*') is-invalid @enderror" 
                                   accept="image/*" multiple>
                            @error('images.*')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">
                                <i class="fas fa-info-circle me-1"></i>
                                Select multiple images (JPEG, PNG, JPG, GIF). Max 2MB per image.
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

    // Handle primary destination change to avoid duplication in additional destinations
    const primaryDestination = document.getElementById('destination_id');
    const additionalDestinations = document.querySelectorAll('input[name="additional_destinations[]"]');

    primaryDestination.addEventListener('change', function() {
        additionalDestinations.forEach(checkbox => {
            if (checkbox.value === this.value) {
                checkbox.checked = false;
                checkbox.disabled = true;
            } else {
                checkbox.disabled = false;
            }
        });
    });
});
</script>
@endsection
