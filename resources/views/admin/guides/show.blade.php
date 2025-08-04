@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Guide Details</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.guides.index') }}">Tour Guides</a></li>
        <li class="breadcrumb-item active">Guide Details</li>
    </ol>

    <div class="row">
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-user me-1"></i>
                    Profile Photo
                </div>
                <div class="card-body text-center">
                    <img src="{{ $guide->profile_photo_url }}" alt="{{ $guide->name }}" 
                         class="img-fluid rounded-circle" style="width: 200px; height: 200px; object-fit: cover;">
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div>
                        <i class="fas fa-info-circle me-1"></i>
                        Guide Information
                    </div>
                    <div>
                        <a href="{{ route('admin.guides.edit', $guide) }}" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <a href="{{ route('admin.guides.index') }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-arrow-left"></i> Back
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Personal Information</h5>
                            <table class="table table-borderless">
                                <tr>
                                    <td><strong>Name:</strong></td>
                                    <td>{{ $guide->name }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Email:</strong></td>
                                    <td>{{ $guide->email ?? 'Not provided' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Phone:</strong></td>
                                    <td>{{ $guide->phone ?? 'Not provided' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Location:</strong></td>
                                    <td>{{ $guide->location ?? 'Not specified' }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <h5>Professional Information</h5>
                            <table class="table table-borderless">
                                <tr>
                                    <td><strong>Experience:</strong></td>
                                    <td>{{ $guide->experience_years }} years</td>
                                </tr>
                                <tr>
                                    <td><strong>Languages:</strong></td>
                                    <td>{{ $guide->languages_list ?: 'Not specified' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Status:</strong></td>
                                    <td>
                                        @if($guide->is_active)
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-secondary">Inactive</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Joined:</strong></td>
                                    <td>{{ $guide->created_at->format('M d, Y') }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-12">
                            <h5>Bio</h5>
                            <p>{{ $guide->bio }}</p>
                        </div>
                    </div>

                    @if($guide->specializations)
                    <div class="row mt-4">
                        <div class="col-12">
                            <h5>Specializations</h5>
                            <p>{{ $guide->specializations }}</p>
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-calendar me-1"></i>
                    Recent Bookings
                </div>
                <div class="card-body">
                    @php
                        $recentBookings = $guide->bookings()->with(['tour', 'user'])->latest()->take(5)->get();
                    @endphp
                    
                    @if($recentBookings->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Tour</th>
                                        <th>Customer</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($recentBookings as $booking)
                                    <tr>
                                        <td>{{ $booking->tour->title }}</td>
                                        <td>{{ $booking->user->name }}</td>
                                        <td>{{ $booking->booking_date->format('M d, Y') }}</td>
                                        <td>
                                            <span class="badge bg-{{ $booking->status === 'approved' ? 'success' : ($booking->status === 'pending' ? 'warning' : 'danger') }}">
                                                {{ ucfirst($booking->status) }}
                                            </span>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-muted">No bookings found for this guide.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 