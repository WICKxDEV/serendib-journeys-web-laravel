@extends('layouts.admin')

@section('title', 'Add New Activity')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">
                        <i class="fas fa-plus me-2"></i>
                        Add New Activity
                    </h4>
                    <a href="{{ route('admin.activities.index') }}" class="btn btn-outline-secondary btn-sm">
                        <i class="fas fa-arrow-left me-1"></i>
                        Back to Activities
                    </a>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.activities.store') }}" method="POST">
                        @csrf
                        
                        <div class="row">
                            <!-- Activity Name -->
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label">
                                    <i class="fas fa-tag me-1"></i>
                                    Activity Name *
                                </label>
                                <input type="text" name="name" id="name" value="{{ old('name') }}" 
                                       class="form-control @error('name') is-invalid @enderror" 
                                       placeholder="Enter activity name" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Category -->
                            <div class="col-md-6 mb-3">
                                <label for="category" class="form-label">
                                    <i class="fas fa-folder me-1"></i>
                                    Category
                                </label>
                                <select name="category" id="category" class="form-select @error('category') is-invalid @enderror">
                                    <option value="">Select Category</option>
                                    <option value="Adventure" {{ old('category') == 'Adventure' ? 'selected' : '' }}>Adventure</option>
                                    <option value="Cultural" {{ old('category') == 'Cultural' ? 'selected' : '' }}>Cultural</option>
                                    <option value="Nature" {{ old('category') == 'Nature' ? 'selected' : '' }}>Nature</option>
                                    <option value="Wildlife" {{ old('category') == 'Wildlife' ? 'selected' : '' }}>Wildlife</option>
                                    <option value="Water Sports" {{ old('category') == 'Water Sports' ? 'selected' : '' }}>Water Sports</option>
                                    <option value="Sightseeing" {{ old('category') == 'Sightseeing' ? 'selected' : '' }}>Sightseeing</option>
                                    <option value="Food & Dining" {{ old('category') == 'Food & Dining' ? 'selected' : '' }}>Food & Dining</option>
                                    <option value="Wellness" {{ old('category') == 'Wellness' ? 'selected' : '' }}>Wellness</option>
                                    <option value="Shopping" {{ old('category') == 'Shopping' ? 'selected' : '' }}>Shopping</option>
                                    <option value="Transportation" {{ old('category') == 'Transportation' ? 'selected' : '' }}>Transportation</option>
                                    <option value="Other" {{ old('category') == 'Other' ? 'selected' : '' }}>Other</option>
                                </select>
                                @error('category')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="mb-3">
                            <label for="description" class="form-label">
                                <i class="fas fa-align-left me-1"></i>
                                Description
                            </label>
                            <textarea name="description" id="description" rows="4" 
                                      class="form-control @error('description') is-invalid @enderror" 
                                      placeholder="Enter detailed description of the activity...">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">
                                <i class="fas fa-info-circle me-1"></i>
                                Provide a detailed description of what this activity includes.
                            </div>
                        </div>

                        <div class="row">
                            <!-- Duration -->
                            <div class="col-md-4 mb-3">
                                <label for="duration" class="form-label">
                                    <i class="fas fa-clock me-1"></i>
                                    Duration
                                </label>
                                <input type="text" name="duration" id="duration" value="{{ old('duration') }}" 
                                       class="form-control @error('duration') is-invalid @enderror" 
                                       placeholder="e.g., 2 hours, Half day, Full day">
                                @error('duration')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text">
                                    <small>Examples: "2 hours", "Half day", "Full day", "3-4 hours"</small>
                                </div>
                            </div>

                            <!-- Price -->
                            <div class="col-md-4 mb-3">
                                <label for="price" class="form-label">
                                    <i class="fas fa-dollar-sign me-1"></i>
                                    Price (USD)
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text">$</span>
                                    <input type="number" step="0.01" name="price" id="price" 
                                           value="{{ old('price') }}" 
                                           class="form-control @error('price') is-invalid @enderror" 
                                           placeholder="0.00" min="0">
                                </div>
                                @error('price')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text">
                                    <small>Leave empty or 0 for free activities</small>
                                </div>
                            </div>

                            <!-- Status -->
                            <div class="col-md-4 mb-3">
                                <label for="is_active" class="form-label">
                                    <i class="fas fa-toggle-on me-1"></i>
                                    Status
                                </label>
                                <select name="is_active" id="is_active" class="form-select @error('is_active') is-invalid @enderror">
                                    <option value="1" {{ old('is_active', '1') == '1' ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ old('is_active') == '0' ? 'selected' : '' }}>Inactive</option>
                                </select>
                                @error('is_active')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text">
                                    <small>Only active activities will be available for tour selection</small>
                                </div>
                            </div>
                        </div>

                        <!-- Example Activities Info Box -->
                        <div class="alert alert-info mb-4">
                            <h6 class="alert-heading">
                                <i class="fas fa-lightbulb me-2"></i>
                                Activity Examples
                            </h6>
                            <div class="row">
                                <div class="col-md-6">
                                    <ul class="mb-0">
                                        <li><strong>Adventure:</strong> Rock climbing, Zip-lining, White water rafting</li>
                                        <li><strong>Cultural:</strong> Temple visits, Traditional dance shows, Cooking classes</li>
                                        <li><strong>Nature:</strong> Hiking, Bird watching, Botanical garden tours</li>
                                        <li><strong>Wildlife:</strong> Safari tours, Elephant watching, Whale watching</li>
                                    </ul>
                                </div>
                                <div class="col-md-6">
                                    <ul class="mb-0">
                                        <li><strong>Water Sports:</strong> Snorkeling, Surfing, Boat rides</li>
                                        <li><strong>Wellness:</strong> Spa treatments, Yoga sessions, Meditation</li>
                                        <li><strong>Food & Dining:</strong> Local food tours, Fine dining, Street food experiences</li>
                                        <li><strong>Transportation:</strong> Airport transfers, Vehicle rentals, Train rides</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- Form Actions -->
                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('admin.activities.index') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-times me-1"></i>
                                Cancel
                            </a>
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-save me-1"></i>
                                Create Activity
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Auto-generate activity suggestions based on category
    const categorySelect = document.getElementById('category');
    const nameInput = document.getElementById('name');
    
    const suggestions = {
        'Adventure': ['Rock Climbing', 'Zip Lining', 'White Water Rafting', 'Bungee Jumping', 'Paragliding'],
        'Cultural': ['Temple Visit', 'Traditional Dance Show', 'Cooking Class', 'Art Gallery Tour', 'Heritage Walk'],
        'Nature': ['Forest Hiking', 'Bird Watching', 'Botanical Garden Tour', 'Nature Photography', 'Eco Walk'],
        'Wildlife': ['Safari Tour', 'Elephant Watching', 'Whale Watching', 'Leopard Spotting', 'Bird Safari'],
        'Water Sports': ['Snorkeling', 'Surfing Lessons', 'Boat Ride', 'Jet Skiing', 'Deep Sea Fishing'],
        'Sightseeing': ['City Tour', 'Scenic Drive', 'Viewpoint Visit', 'Landmark Tour', 'Photography Tour'],
        'Food & Dining': ['Local Food Tour', 'Street Food Experience', 'Fine Dining', 'Spice Garden Tour', 'Tea Tasting'],
        'Wellness': ['Spa Treatment', 'Yoga Session', 'Meditation Class', 'Ayurveda Treatment', 'Wellness Retreat'],
        'Shopping': ['Local Market Tour', 'Souvenir Shopping', 'Handicraft Workshop', 'Gem Shopping', 'Textile Shopping'],
        'Transportation': ['Airport Transfer', 'Vehicle Rental', 'Train Journey', 'Tuk Tuk Ride', 'Helicopter Tour']
    };
    
    categorySelect.addEventListener('change', function() {
        if (this.value && suggestions[this.value] && !nameInput.value) {
            // Show suggestions as placeholder
            nameInput.placeholder = 'e.g., ' + suggestions[this.value].slice(0, 3).join(', ');
        }
    });
});
</script>
@endsection