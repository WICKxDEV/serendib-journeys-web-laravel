@extends('layouts.admin')

@section('title', 'Activity Details')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">
            <i class="fas fa-hiking me-2"></i>
            Activity Details
        </h1>
        <div class="btn-group">
            <a href="{{ route('admin.activities.edit', $activity) }}" class="btn btn-warning">
                <i class="fas fa-edit me-1"></i>
                Edit Activity
            </a>
            <a href="{{ route('admin.activities.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left me-1"></i>
                Back to Activities
            </a>
        </div>
    </div>

    <div class="row">
        <!-- Activity Information -->
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="fas fa-info-circle me-2"></i>
                        Activity Information
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <h4 class="text-primary">{{ $activity->name }}</h4>
                            @if($activity->category)
                                <span class="badge bg-info fs-6">{{ $activity->category }}</span>
                            @endif
                        </div>
                        <div class="col-md-6 text-end">
                            @if($activity->is_active)
                                <span class="badge bg-success fs-6">Active</span>
                            @else
                                <span class="badge bg-secondary fs-6">Inactive</span>
                            @endif
                        </div>
                    </div>

                    @if($activity->description)
                    <div class="mb-4">
                        <h6 class="text-muted">Description:</h6>
                        <p class="lead">{{ $activity->description }}</p>
                    </div>
                    @endif

                    <div class="row">
                        @if($activity->duration)
                        <div class="col-md-4 mb-3">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-clock text-info me-2"></i>
                                <div>
                                    <small class="text-muted">Duration</small>
                                    <div class="fw-bold">{{ $activity->duration }}</div>
                                </div>
                            </div>
                        </div>
                        @endif

                        <div class="col-md-4 mb-3">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-dollar-sign text-success me-2"></i>
                                <div>
                                    <small class="text-muted">Price</small>
                                    <div class="fw-bold">
                                        @if($activity->price && $activity->price > 0)
                                            ${{ number_format($activity->price, 2) }}
                                        @else
                                            <span class="text-success">Free</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 mb-3">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-calendar text-primary me-2"></i>
                                <div>
                                    <small class="text-muted">Created</small>
                                    <div class="fw-bold">{{ $activity->created_at->format('M d, Y') }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Associated Tours -->
            @if($activity->tours->count() > 0)
            <div class="card mt-4">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="fas fa-route me-2"></i>
                        Associated Tours ({{ $activity->tours->count() }})
                    </h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Tour Name</th>
                                    <th>Base Price</th>
                                    <th>Total Price</th>
                                    <th>Day</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($activity->tours as $tour)
                                    <tr>
                                        <td>
                                            <strong>{{ $tour->title }}</strong>
                                            <br>
                                            <small class="text-muted">{{ Str::limit($tour->description, 50) }}</small>
                                        </td>
                                        <td>${{ number_format($tour->base_price, 2) }}</td>
                                        <td>
                                            <span class="text-success fw-bold">${{ number_format($tour->total_price, 2) }}</span>
                                        </td>
                                        <td>
                                            @if($tour->pivot->day)
                                                <span class="badge bg-primary">Day {{ $tour->pivot->day }}</span>
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.tours.edit', $tour) }}" 
                                               class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-edit"></i> Edit Tour
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @endif
        </div>

        <!-- Side Panel -->
        <div class="col-md-4">
            <!-- Quick Stats -->
            <div class="card">
                <div class="card-header">
                    <h6 class="mb-0">
                        <i class="fas fa-chart-bar me-2"></i>
                        Quick Stats
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-6">
                            <div class="h3 text-primary">{{ $activity->tours->count() }}</div>
                            <small class="text-muted">Tours Using</small>
                        </div>
                        <div class="col-6">
                            <div class="h3 text-success">
                                @if($activity->price && $activity->price > 0)
                                    ${{ number_format($activity->price, 2) }}
                                @else
                                    Free
                                @endif
                            </div>
                            <small class="text-muted">Price</small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Activity Actions -->
            <div class="card mt-4">
                <div class="card-header">
                    <h6 class="mb-0">
                        <i class="fas fa-tools me-2"></i>
                        Actions
                    </h6>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="{{ route('admin.activities.edit', $activity) }}" class="btn btn-warning">
                            <i class="fas fa-edit me-2"></i>
                            Edit Activity
                        </a>
                        
                        <form action="{{ route('admin.activities.toggle-status', $activity) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-{{ $activity->is_active ? 'secondary' : 'success' }} w-100">
                                <i class="fas fa-{{ $activity->is_active ? 'pause' : 'play' }} me-2"></i>
                                {{ $activity->is_active ? 'Deactivate' : 'Activate' }} Activity
                            </button>
                        </form>

                        @if($activity->tours->count() == 0)
                            <form action="{{ route('admin.activities.destroy', $activity) }}" method="POST" 
                                  onsubmit="return confirm('Are you sure you want to delete this activity? This action cannot be undone.')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger w-100">
                                    <i class="fas fa-trash me-2"></i>
                                    Delete Activity
                                </button>
                            </form>
                        @else
                            <button class="btn btn-danger w-100" disabled title="Cannot delete - activity is used in tours">
                                <i class="fas fa-trash me-2"></i>
                                Delete Activity
                            </button>
                            <small class="text-muted text-center d-block mt-1">
                                Remove from all tours first to delete
                            </small>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Activity Meta -->
            <div class="card mt-4">
                <div class="card-header">
                    <h6 class="mb-0">
                        <i class="fas fa-info me-2"></i>
                        Meta Information
                    </h6>
                </div>
                <div class="card-body">
                    <small class="text-muted">
                        <strong>ID:</strong> {{ $activity->id }}<br>
                        <strong>Created:</strong> {{ $activity->created_at->format('M d, Y \a\t H:i') }}<br>
                        <strong>Updated:</strong> {{ $activity->updated_at->format('M d, Y \a\t H:i') }}<br>
                        @if($activity->category)
                        <strong>Category:</strong> {{ $activity->category }}<br>
                        @endif
                        @if($activity->duration)
                        <strong>Duration:</strong> {{ $activity->duration }}<br>
                        @endif
                        <strong>Status:</strong> 
                        <span class="badge bg-{{ $activity->is_active ? 'success' : 'secondary' }}">
                            {{ $activity->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </small>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection