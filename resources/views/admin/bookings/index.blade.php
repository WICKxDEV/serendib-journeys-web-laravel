@extends('layouts.admin')

@section('title', 'Bookings Management')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0">Bookings Management</h1>
    <a href="{{ route('admin.bookings.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> Add New Booking
    </a>
</div>

<div class="card">
    <div class="card-header">
        <h5 class="card-title mb-0">All Bookings</h5>
    </div>
    <div class="card-body">
        @if($bookings->count() > 0)
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Customer</th>
                            <th>Tour</th>
                            <th>Date</th>
                            <th>Guests</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Payment</th>
                            <th>Guide</th>
                            <th>Invoice</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($bookings as $booking)
                            <tr>
                                <td>{{ $booking->id }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-user-circle fa-2x text-primary me-2"></i>
                                        <div>
                                            <strong>{{ $booking->user->name ?? $booking->guest_name ?? 'Guest' }}</strong>
                                            <br>
                                            <small class="text-muted">{{ $booking->user->email ?? $booking->guest_email ?? '' }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <strong>{{ $booking->tour->title }}</strong>
                                    <br>
                                    <small class="text-muted">{{ $booking->tour->destination->name }}</small>
                                </td>
                                <td>{{ $booking->booking_date->format('M d, Y') }}</td>
                                <td>
                                    <span class="badge bg-info">{{ $booking->guests }} guests</span>
                                </td>
                                <td>${{ number_format($booking->total_price, 2) }}</td>
                                <td>
                                    <span class="badge bg-{{ $booking->status == 'approved' ? 'success' : ($booking->status == 'pending' ? 'warning' : 'secondary') }}">
                                        {{ ucfirst($booking->status) }}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge bg-{{ $booking->payment_status == 'paid' ? 'success' : ($booking->payment_status == 'unpaid' ? 'warning' : 'info') }}">
                                        {{ ucfirst($booking->payment_status) }}
                                    </span>
                                </td>
                                <td>
                                    @if($booking->guide)
                                        <strong>{{ $booking->guide->name }}</strong><br>
                                        <small class="text-muted">{{ $booking->guide->email }}</small>
                                    @else
                                        <span class="text-muted">Unassigned</span>
                                    @endif
                                </td>
                                <td>
                                    @if($booking->invoice_path)
                                        <a href="{{ asset('storage/' . $booking->invoice_path) }}" target="_blank" class="btn btn-sm btn-outline-primary">View Invoice</a>
                                    @else
                                        <span class="text-muted">N/A</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('admin.bookings.show', $booking) }}" 
                                           class="btn btn-sm btn-outline-primary" 
                                           title="View">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.bookings.edit', $booking) }}" 
                                           class="btn btn-sm btn-outline-warning" 
                                           title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        
                                        <!-- Status Change Dropdown -->
                                        <div class="btn-group" role="group">
                                            <button type="button" class="btn btn-sm btn-outline-success dropdown-toggle" data-bs-toggle="dropdown">
                                                <i class="fas fa-cog"></i>
                                            </button>
                                            <ul class="dropdown-menu">
                                                @if($booking->status !== 'approved')
                                                    <li>
                                                        <form action="{{ route('admin.bookings.changeStatus', $booking) }}" method="POST" class="d-inline">
                                                            @csrf
                                                            <input type="hidden" name="status" value="approved">
                                                            <input type="hidden" name="payment_status" value="paid">
                                                            <button type="submit" class="dropdown-item text-success">
                                                                <i class="fas fa-check"></i> Approve & Mark Paid
                                                            </button>
                                                        </form>
                                                    </li>
                                                @endif
                                                @if($booking->status !== 'cancelled')
                                                    <li>
                                                        <form action="{{ route('admin.bookings.changeStatus', $booking) }}" method="POST" class="d-inline">
                                                            @csrf
                                                            <input type="hidden" name="status" value="cancelled">
                                                            <input type="hidden" name="payment_status" value="refunded">
                                                            <button type="submit" class="dropdown-item text-danger">
                                                                <i class="fas fa-times"></i> Cancel & Refund
                                                            </button>
                                                        </form>
                                                    </li>
                                                @endif
                                            </ul>
                                        </div>
                                        
                                        <form action="{{ route('admin.bookings.destroy', $booking) }}" 
                                              method="POST" 
                                              class="d-inline"
                                              onsubmit="return confirm('Are you sure you want to delete this booking?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="btn btn-sm btn-outline-danger" 
                                                    title="Delete">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <div class="d-flex justify-content-center mt-4">
                {{ $bookings->links('pagination::bootstrap-4') }}
            </div>
        @else
            <div class="text-center py-4">
                <i class="fas fa-calendar-times fa-3x text-muted mb-3"></i>
                <h5>No bookings found</h5>
                <p class="text-muted">No bookings have been made yet.</p>
                <a href="{{ route('admin.bookings.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Add New Booking
                </a>
            </div>
        @endif
    </div>
</div>

<!-- Statistics Cards -->
<div class="row mt-4">
    <div class="col-md-3">
        <div class="card bg-primary text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h4 class="mb-0">{{ $bookings->count() }}</h4>
                        <p class="mb-0">Total Bookings</p>
                    </div>
                    <div class="align-self-center">
                        <i class="fas fa-calendar fa-2x"></i>
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
                        <h4 class="mb-0">{{ $bookings->where('status', 'approved')->count() }}</h4>
                        <p class="mb-0">Approved</p>
                    </div>
                    <div class="align-self-center">
                        <i class="fas fa-check fa-2x"></i>
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
                        <h4 class="mb-0">{{ $bookings->where('status', 'pending')->count() }}</h4>
                        <p class="mb-0">Pending</p>
                    </div>
                    <div class="align-self-center">
                        <i class="fas fa-clock fa-2x"></i>
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
                        <h4 class="mb-0">${{ number_format($bookings->where('payment_status', 'paid')->sum('total_price'), 2) }}</h4>
                        <p class="mb-0">Total Revenue</p>
                    </div>
                    <div class="align-self-center">
                        <i class="fas fa-dollar-sign fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 