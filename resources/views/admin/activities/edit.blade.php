@extends('layouts.admin')

@section('title', 'Edit Activity')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">
                        <i class="fas fa-edit me-2"></i>
                        Edit Activity: {{ $activity->name }}
                    </h4>
                    <div class="btn-group">
                        <a href="{{ route('admin.activities.show', $activity) }}" class="btn btn-outline-info btn-sm">
                            <i class="fas fa-eye me-1"></i>
                            View
                        </a>
                        <a href="{{ route('admin.activities.index') }}" class="btn btn-outline-secondary btn-sm">
                            <i class="fas fa-arrow-left me-1"></i>
                            Back to Activities
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.activities.update', $activity) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="row">
                            <!-- Activity Name -->
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label">
                                    <i class="fas fa-tag me-1"></i>
                                    Activity Name *
                                </label>
                                <input type="text" name="name" id="name" value="{{ old('name', $activity->name) }}" 
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
                                    <option value="Adventure" {{ old('category', $activity->category) == 'Adventure' ? 'selected' : '' }}>Adventure</option>
                                    <option value="Cultural" {{ old('category', $activity->category) == 'Cultural' ? 'selected' : '' }}>Cultural</option>
                                    <option value="Nature" {{ old('category', $activity->category) == 'Nature' ? 'selected' : '' }}>Nature</option>
                                    <option value="Wildlife" {{ old('category', $activity->category) == 'Wildlife' ? 'selected' : '' }}>Wildlife</option>
                                    <option value="Water Sports" {{ old('category', $activity->category) == 'Water Sports' ? 'selected' : '' }}>Water Sports</option>
                                    <option value="Sightseeing" {{ old('category', $activity->category) == 'Sightseeing' ? 'selected' : '' }}>Sightseeing</option>
                                    <option value="Food & Dining" {{ old('category', $activity->category) == 'Food & Dining' ? 'selected' : '' }}>Food & Dining</option>
                                    <option value="Wellness" {{ old('category', $activity->category) == 'Wellness' ? 'selected' : '' }}>Wellness</option>
                                    <option value="Shopping" {{ old('category', $activity->category) == 'Shopping' ? 'selected' : '' }}>Shopping</option>
                                    <option value="Transportation" {{ old('category', $activity->category) == 'Transportation' ? 'selected' : '' }}>Transportation</option>
                                    <option value="Other" {{ old('category', $activity->category) == 'Other' ? 'selected' : '' }}>Other</option>
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
                                      placeholder="Enter detailed description of the activity...">{{ old('description', $activity->description) }}</textarea>
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
                                <input type="text" name="duration" id="duration" value="{{ old('duration', $activity->duration) }}" 
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
                                           value="{{ old('price', $activity->price) }}" 
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
                                    <option value="1" {{ old('is_active', $activity->is_active) == '1' ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ old('is_active', $activity->is_active) == '0' ? 'selected' : '' }}>Inactive</option>
                                </select>
                                @error('is_active')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text">
                                    <small>Only active activities will be available for tour selection</small>
                                </div>
                            </div>
                        </div>

                        <!-- Usage Information -->
                        @if($activity->tours()->count() > 0)
                        <div class="alert alert-warning mb-4">
                            <h6 class="alert-heading">
                                <i class="fas fa-exclamation-triangle me-2"></i>
                                Activity Usage Information
                            </h6>
                            <p class="mb-2">This activity is currently being used in <strong>{{ $activity->tours()->count() }} tour(s)</strong>:</p>
                            <ul class="mb-0">
                                @foreach($activity->tours()->limit(5)->get() as $tour)
                                    <li>
                                        <a href="{{ route('admin.tours.edit', $tour) }}" class="text-decoration-none">
                                            {{ $tour->title }}
                                        </a>
                                    </li>
                                @endforeach
                                @if($activity->tours()->count() > 5)
                                    <li class="text-muted">... and {{ $activity->tours()->count() - 5 }} more</li>
                                @endif
                            </ul>
                            <small class="text-muted mt-2 d-block">
                                <i class="fas fa-info-circle me-1"></i>
                                Changes to price will affect the total price calculation of these tours.
                            </small>
                        </div>
                        @endif

                        <!-- Form Actions -->
                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('admin.activities.index') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-times me-1"></i>
                                Cancel
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-1"></i>
                                Update Activity
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection