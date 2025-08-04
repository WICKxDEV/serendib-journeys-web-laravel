@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Tour Guides</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Tour Guides</li>
    </ol>

    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div>
                <i class="fas fa-users me-1"></i>
                Manage Tour Guides
            </div>
            <a href="{{ route('admin.guides.create') }}" class="btn btn-primary btn-sm">
                <i class="fas fa-plus"></i> Add New Guide
            </a>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Photo</th>
                            <th>Name</th>
                            <th>Location</th>
                            <th>Languages</th>
                            <th>Experience</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($guides as $guide)
                        <tr>
                            <td>
                                <img src="{{ $guide->profile_photo_url }}" alt="{{ $guide->name }}" 
                                     class="rounded-circle" width="50" height="50" style="object-fit: cover;">
                            </td>
                            <td>
                                <strong>{{ $guide->name }}</strong>
                                @if($guide->email)
                                    <br><small class="text-muted">{{ $guide->email }}</small>
                                @endif
                            </td>
                            <td>{{ $guide->location ?? 'Not specified' }}</td>
                            <td>{{ $guide->languages_list ?: 'Not specified' }}</td>
                            <td>{{ $guide->experience_years }} years</td>
                            <td>
                                @if($guide->is_active)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-secondary">Inactive</span>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('admin.guides.show', $guide) }}" 
                                       class="btn btn-info btn-sm" title="View">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.guides.edit', $guide) }}" 
                                       class="btn btn-warning btn-sm" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.guides.destroy', $guide) }}" 
                                          method="POST" class="d-inline" 
                                          onsubmit="return confirm('Are you sure you want to delete this guide?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center">No guides found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($guides->hasPages())
                <div class="d-flex justify-content-center">
                    {{ $guides->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection 