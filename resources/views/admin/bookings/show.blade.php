@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">
                        <i class="fas fa-eye me-2"></i>
                        Booking Details
                    </h4>
                    <div>
                        <a href="{{ route('admin.bookings.edit', $booking) }}" class="btn btn-outline-warning btn-sm me-2">
                            <i class="fas fa-edit me-1"></i>
                            Edit Booking
                        </a>
                        <a href="{{ route('admin.bookings.index') }}" class="btn btn-outline-secondary btn-sm">
                            <i class="fas fa-arrow-left me-1"></i>
                            Back to Bookings
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Booking Information -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="card bg-light">
                                <div class="card-body">
                                    <h6 class="card-title">
                                        <i class="fas fa-info-circle me-1"></i>
                                        Booking Information
                                    </h6>
                                    <p class="mb-1"><strong>Booking ID:</strong> #{{ $booking->id }}</p>
                                    <p class="mb-1"><strong>Created:</strong> {{ $booking->created_at->format('M d, Y \a\t g:i A') }}</p>
                                    <p class="mb-1"><strong>Last Updated:</strong> {{ $booking->updated_at->format('M d, Y \a\t g:i A') }}</p>
                                    <p class="mb-0"><strong>Booking Date:</strong> {{ $booking->booking_date->format('M d, Y') }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card bg-light">
                                <div class="card-body">
                                    <h6 class="card-title">
                                        <i class="fas fa-map-marked-alt me-1"></i>
                                        Tour Information
                                    </h6>
                                    <p class="mb-1"><strong>Tour:</strong> {{ $booking->tour->title }}</p>
                                    <p class="mb-1"><strong>Destination:</strong> {{ $booking->tour->destination->name }}</p>
                                    <p class="mb-0"><strong>Tour Price:</strong> ${{ number_format($booking->tour->price, 2) }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Customer Information -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h6 class="mb-0">
                                        <i class="fas fa-user me-1"></i>
                                        Customer Information
                                    </h6>
                                </div>
                                <div class="card-body">
                                    @if($booking->user)
                                        <div class="d-flex align-items-center mb-3">
                                            <i class="fas fa-user-circle fa-3x text-primary me-3"></i>
                                            <div>
                                                <h6 class="mb-1">{{ $booking->user->name }}</h6>
                                                <p class="mb-1 text-muted">{{ $booking->user->email }}</p>
                                                <small class="text-muted">Registered User</small>
                                            </div>
                                        </div>
                                    @else
                                        <div class="d-flex align-items-center mb-3">
                                            <i class="fas fa-user-circle fa-3x text-secondary me-3"></i>
                                            <div>
                                                <h6 class="mb-1">{{ $booking->guest_name ?? 'Guest' }}</h6>
                                                <p class="mb-1 text-muted">{{ $booking->guest_email ?? 'No email provided' }}</p>
                                                <small class="text-muted">Guest User</small>
                                            </div>
                                        </div>
                                    @endif
                                    
                                    @if($booking->guest_phone)
                                        <p class="mb-1"><strong>Phone:</strong> {{ $booking->guest_phone }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h6 class="mb-0">
                                        <i class="fas fa-user-tie me-1"></i>
                                        Guide Information
                                    </h6>
                                </div>
                                <div class="card-body">
                                    @if($booking->guide)
                                        <div class="d-flex align-items-center mb-3">
                                            <i class="fas fa-user-tie fa-3x text-success me-3"></i>
                                            <div>
                                                <h6 class="mb-1">{{ $booking->guide->name }}</h6>
                                                <p class="mb-1 text-muted">{{ $booking->guide->email }}</p>
                                                <small class="text-success">Assigned Guide</small>
                                            </div>
                                        </div>
                                    @else
                                        <div class="text-center py-3">
                                            <i class="fas fa-user-times fa-3x text-muted mb-3"></i>
                                            <p class="text-muted mb-0">No guide assigned</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Booking Details -->
                    <div class="row mb-4">
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body text-center">
                                    <i class="fas fa-users fa-3x text-info mb-3"></i>
                                    <h4 class="mb-1">{{ $booking->guests }}</h4>
                                    <p class="mb-0 text-muted">Number of Guests</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body text-center">
                                    <i class="fas fa-dollar-sign fa-3x text-success mb-3"></i>
                                    <h4 class="mb-1">${{ number_format($booking->total_price, 2) }}</h4>
                                    <p class="mb-0 text-muted">Total Price</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body text-center">
                                    <i class="fas fa-calendar-alt fa-3x text-primary mb-3"></i>
                                    <h4 class="mb-1">{{ $booking->booking_date->format('M d') }}</h4>
                                    <p class="mb-0 text-muted">Booking Date</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Status Information -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h6 class="mb-0">
                                        <i class="fas fa-tasks me-1"></i>
                                        Booking Status
                                    </h6>
                                </div>
                                <div class="card-body">
                                    @switch($booking->status)
                                        @case('approved')
                                            <div class="d-flex align-items-center">
                                                <i class="fas fa-check-circle fa-2x text-success me-3"></i>
                                                <div>
                                                    <h6 class="mb-1 text-success">Approved</h6>
                                                    <p class="mb-0 text-muted">This booking has been approved and confirmed.</p>
                                                </div>
                                            </div>
                                            @break
                                        @case('pending')
                                            <div class="d-flex align-items-center">
                                                <i class="fas fa-clock fa-2x text-warning me-3"></i>
                                                <div>
                                                    <h6 class="mb-1 text-warning">Pending</h6>
                                                    <p class="mb-0 text-muted">This booking is awaiting approval.</p>
                                                </div>
                                            </div>
                                            @break
                                        @case('cancelled')
                                            <div class="d-flex align-items-center">
                                                <i class="fas fa-times-circle fa-2x text-danger me-3"></i>
                                                <div>
                                                    <h6 class="mb-1 text-danger">Cancelled</h6>
                                                    <p class="mb-0 text-muted">This booking has been cancelled.</p>
                                                </div>
                                            </div>
                                            @break
                                    @endswitch
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h6 class="mb-0">
                                        <i class="fas fa-credit-card me-1"></i>
                                        Payment Status
                                    </h6>
                                </div>
                                <div class="card-body">
                                    @switch($booking->payment_status)
                                        @case('paid')
                                            <div class="d-flex align-items-center">
                                                <i class="fas fa-check-circle fa-2x text-success me-3"></i>
                                                <div>
                                                    <h6 class="mb-1 text-success">Paid</h6>
                                                    <p class="mb-0 text-muted">Payment has been received.</p>
                                                </div>
                                            </div>
                                            @break
                                        @case('unpaid')
                                            <div class="d-flex align-items-center">
                                                <i class="fas fa-clock fa-2x text-warning me-3"></i>
                                                <div>
                                                    <h6 class="mb-1 text-warning">Unpaid</h6>
                                                    <p class="mb-0 text-muted">Payment is pending.</p>
                                                </div>
                                            </div>
                                            @break
                                        @case('refunded')
                                            <div class="d-flex align-items-center">
                                                <i class="fas fa-undo fa-2x text-info me-3"></i>
                                                <div>
                                                    <h6 class="mb-1 text-info">Refunded</h6>
                                                    <p class="mb-0 text-muted">Payment has been refunded.</p>
                                                </div>
                                            </div>
                                            @break
                                    @endswitch
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Special Requests -->
                    @if($booking->special_requests)
                    <div class="card mb-4">
                        <div class="card-header">
                            <h6 class="mb-0">
                                <i class="fas fa-comment me-1"></i>
                                Special Requests
                            </h6>
                        </div>
                        <div class="card-body">
                            <div class="border rounded p-3 bg-light">
                                <p class="mb-0">{{ $booking->special_requests }}</p>
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- Action Buttons -->
                    <div class="d-flex justify-content-between mt-4">
                        <div>
                            <form action="{{ route('admin.bookings.destroy', $booking) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger" 
                                        onclick="return confirm('Are you sure you want to delete this booking? This action cannot be undone.')">
                                    <i class="fas fa-trash me-1"></i>
                                    Delete Booking
                                </button>
                            </form>
                        </div>
                        <div>
                            <a href="{{ route('admin.bookings.edit', $booking) }}" class="btn btn-warning">
                                <i class="fas fa-edit me-1"></i>
                                Edit Booking
                            </a>
                            <a href="{{ route('admin.bookings.index') }}" class="btn btn-secondary">
                                <i class="fas fa-list me-1"></i>
                                Back to List
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 