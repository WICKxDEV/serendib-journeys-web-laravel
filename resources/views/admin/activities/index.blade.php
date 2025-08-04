@extends('layouts.admin')

@section('title', 'Activities Management')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">
            <i class="fas fa-hiking me-2"></i>
            Activities Management
        </h1>
        <a href="{{ route('admin.activities.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-1"></i>
            Add New Activity
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i>
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Activities Table -->
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">
                <i class="fas fa-list me-2"></i>
                All Activities ({{ $activities->count() }})
            </h5>
        </div>
        <div class="card-body">
            @if($activities->count() > 0)
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Duration</th>
                                <th>Price (USD)</th>
                                <th>Status</th>
                                <th>Used in Tours</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($activities as $activity)
                                <tr>
                                    <td>{{ $activity->id }}</td>
                                    <td>
                                        <strong>{{ $activity->name }}</strong>
                                        @if($activity->description)
                                            <br>
                                            <small class="text-muted">{{ Str::limit($activity->description, 50) }}</small>
                                        @endif
                                    </td>
                                    <td>
                                        @if($activity->category)
                                            <span class="badge bg-info">{{ $activity->category }}</span>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td>{{ $activity->duration ?? '-' }}</td>
                                    <td>
                                        @if($activity->price)
                                            <span class="text-success fw-bold">${{ number_format($activity->price, 2) }}</span>
                                        @else
                                            <span class="text-muted">Free</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($activity->is_active)
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-secondary">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="badge bg-primary">{{ $activity->tours()->count() }} tours</span>
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('admin.activities.show', $activity) }}" 
                                               class="btn btn-sm btn-outline-info" title="View">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.activities.edit', $activity) }}" 
                                               class="btn btn-sm btn-outline-warning" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.activities.toggle-status', $activity) }}" 
                                                  method="POST" class="d-inline">
                                                @csrf
                                                <button type="submit" 
                                                        class="btn btn-sm btn-outline-{{ $activity->is_active ? 'secondary' : 'success' }}" 
                                                        title="{{ $activity->is_active ? 'Deactivate' : 'Activate' }}">
                                                    <i class="fas fa-{{ $activity->is_active ? 'pause' : 'play' }}"></i>
                                                </button>
                                            </form>
                                            @if($activity->tours()->count() == 0)
                                                <form action="{{ route('admin.activities.destroy', $activity) }}" 
                                                      method="POST" class="d-inline" 
                                                      onsubmit="return confirm('Are you sure you want to delete this activity?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            @else
                                                <button class="btn btn-sm btn-outline-danger" disabled title="Cannot delete - used in tours">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-5">
                    <i class="fas fa-hiking fa-4x text-muted mb-3"></i>
                    <h4 class="text-muted">No Activities Found</h4>
                    <p class="text-muted">Create your first activity to get started.</p>
                    <a href="{{ route('admin.activities.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus me-1"></i>
                        Add First Activity
                    </a>
                </div>
            @endif
        </div>
    </div>

    <!-- Quick Stats -->
    <div class="row mt-4">
        <div class="col-md-3">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h4>{{ $activities->count() }}</h4>
                            <p class="mb-0">Total Activities</p>
                        </div>
                        <div class="align-self-center">
                            <i class="fas fa-hiking fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h4>{{ $activities->where('is_active', true)->count() }}</h4>
                            <p class="mb-0">Active Activities</p>
                        </div>
                        <div class="align-self-center">
                            <i class="fas fa-check-circle fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-info text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h4>{{ $activities->whereNotNull('price')->where('price', '>', 0)->count() }}</h4>
                            <p class="mb-0">Paid Activities</p>
                        </div>
                        <div class="align-self-center">
                            <i class="fas fa-dollar-sign fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-warning text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h4>{{ $activities->where('is_active', false)->count() }}</h4>
                            <p class="mb-0">Inactive Activities</p>
                        </div>
                        <div class="align-self-center">
                            <i class="fas fa-pause-circle fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection