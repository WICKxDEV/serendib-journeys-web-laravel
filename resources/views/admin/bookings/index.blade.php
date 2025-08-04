@extends('layouts.admin')

@section('title', 'Bookings Management')

@section('content')
<div class="container-fluid">
    <!-- Header Section -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0">
                <i class="fas fa-calendar-check me-2"></i>
                Bookings Management
            </h1>
            <p class="text-muted mb-0">Manage all tour bookings and reservations</p>
        </div>
        <a href="{{ route('admin.bookings.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-1"></i>
            Add New Booking
        </a>
    </div>

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h4 class="mb-0">{{ $bookings->total() }}</h4>
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

    <!-- Active Filters Summary -->
    @if(request('search') || request('status') || request('payment_status') || request('date_from') || request('date_to'))
    <div class="alert alert-info mb-4">
        <h6 class="mb-2">
            <i class="fas fa-filter me-1"></i>
            Active Filters
        </h6>
        <div class="d-flex flex-wrap gap-2">
            @if(request('search'))
                <span class="badge bg-primary">
                    <i class="fas fa-search me-1"></i>
                    Search: "{{ request('search') }}"
                </span>
            @endif
            @if(request('status'))
                <span class="badge bg-warning">
                    <i class="fas fa-tasks me-1"></i>
                    Status: {{ ucfirst(request('status')) }}
                </span>
            @endif
            @if(request('payment_status'))
                <span class="badge bg-info">
                    <i class="fas fa-credit-card me-1"></i>
                    Payment: {{ ucfirst(request('payment_status')) }}
                </span>
            @endif
            @if(request('date_from'))
                <span class="badge bg-secondary">
                    <i class="fas fa-calendar me-1"></i>
                    From: {{ \Carbon\Carbon::parse(request('date_from'))->format('M d, Y') }}
                </span>
            @endif
            @if(request('date_to'))
                <span class="badge bg-secondary">
                    <i class="fas fa-calendar me-1"></i>
                    To: {{ \Carbon\Carbon::parse(request('date_to'))->format('M d, Y') }}
                </span>
            @endif
            <a href="{{ route('admin.bookings.index') }}" class="btn btn-sm btn-outline-secondary">
                <i class="fas fa-times me-1"></i>
                Clear All Filters
            </a>
        </div>
    </div>
    @endif

    <!-- Search and Filter Section -->
    <div class="card mb-4">
        <div class="card-header">
            <h6 class="mb-0">
                <i class="fas fa-search me-1"></i>
                Search & Filter
            </h6>
        </div>
        <div class="card-body">
            <form method="GET" action="{{ route('admin.bookings.index') }}" class="row g-3">
                <div class="col-md-3">
                    <label for="search" class="form-label">Search</label>
                    <input type="text" name="search" id="search" 
                           value="{{ request('search') }}" 
                           class="form-control" 
                           placeholder="Search by customer, tour, or booking ID...">
                </div>
                <div class="col-md-2">
                    <label for="status" class="form-label">Status</label>
                    <select name="status" id="status" class="form-select">
                        <option value="">All Status</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Approved</option>
                        <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label for="payment_status" class="form-label">Payment</label>
                    <select name="payment_status" id="payment_status" class="form-select">
                        <option value="">All Payments</option>
                        <option value="unpaid" {{ request('payment_status') == 'unpaid' ? 'selected' : '' }}>Unpaid</option>
                        <option value="paid" {{ request('payment_status') == 'paid' ? 'selected' : '' }}>Paid</option>
                        <option value="refunded" {{ request('payment_status') == 'refunded' ? 'selected' : '' }}>Refunded</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label for="date_from" class="form-label">From Date</label>
                    <input type="date" name="date_from" id="date_from" 
                           value="{{ request('date_from') }}" 
                           class="form-control">
                </div>
                <div class="col-md-2">
                    <label for="date_to" class="form-label">To Date</label>
                    <input type="date" name="date_to" id="date_to" 
                           value="{{ request('date_to') }}" 
                           class="form-control">
                </div>
                <div class="col-md-1">
                    <label class="form-label">&nbsp;</label>
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-search"></i>
                        </button>
                        <a href="{{ route('admin.bookings.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-times"></i>
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Bookings Table -->
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0">
                <i class="fas fa-list me-1"></i>
                All Bookings ({{ $bookings->total() }})
            </h5>
            <div class="btn-group" role="group">
                <button type="button" class="btn btn-outline-secondary btn-sm dropdown-toggle" data-bs-toggle="dropdown">
                    <i class="fas fa-download me-1"></i>
                    Export
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#"><i class="fas fa-file-csv me-1"></i> Export CSV</a></li>
                    <li><a class="dropdown-item" href="#"><i class="fas fa-file-excel me-1"></i> Export Excel</a></li>
                    <li><a class="dropdown-item" href="#"><i class="fas fa-file-pdf me-1"></i> Export PDF</a></li>
                </ul>
            </div>
        </div>
        <div class="card-body">
            @if($bookings->count() > 0)
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead class="table-dark">
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
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($bookings as $booking)
                                <tr>
                                    <td>
                                        <span class="badge bg-secondary">#{{ $booking->id }}</span>
                                    </td>
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
                                        <div>
                                            <strong>{{ $booking->tour->title }}</strong>
                                            <br>
                                            <small class="text-muted">
                                                <i class="fas fa-map-marker-alt me-1"></i>
                                                {{ $booking->tour->destination->name }}
                                            </small>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <strong>{{ $booking->booking_date->format('M d, Y') }}</strong>
                                            <br>
                                            <small class="text-muted">{{ $booking->booking_date->diffForHumans() }}</small>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge bg-info">
                                            <i class="fas fa-users me-1"></i>
                                            {{ $booking->guests }} guests
                                        </span>
                                    </td>
                                    <td>
                                        <strong class="text-success">${{ number_format($booking->total_price, 2) }}</strong>
                                    </td>
                                    <td>
                                        @switch($booking->status)
                                            @case('approved')
                                                <span class="badge bg-success">
                                                    <i class="fas fa-check me-1"></i>
                                                    Approved
                                                </span>
                                                @break
                                            @case('pending')
                                                <span class="badge bg-warning">
                                                    <i class="fas fa-clock me-1"></i>
                                                    Pending
                                                </span>
                                                @break
                                            @case('cancelled')
                                                <span class="badge bg-danger">
                                                    <i class="fas fa-times me-1"></i>
                                                    Cancelled
                                                </span>
                                                @break
                                        @endswitch
                                    </td>
                                    <td>
                                        @switch($booking->payment_status)
                                            @case('paid')
                                                <span class="badge bg-success">
                                                    <i class="fas fa-check me-1"></i>
                                                    Paid
                                                </span>
                                                @break
                                            @case('unpaid')
                                                <span class="badge bg-warning">
                                                    <i class="fas fa-clock me-1"></i>
                                                    Unpaid
                                                </span>
                                                @break
                                            @case('refunded')
                                                <span class="badge bg-info">
                                                    <i class="fas fa-undo me-1"></i>
                                                    Refunded
                                                </span>
                                                @break
                                        @endswitch
                                    </td>
                                    <td>
                                        @if($booking->guide)
                                            <div>
                                                <strong>{{ $booking->guide->name }}</strong>
                                                <br>
                                                <small class="text-muted">{{ $booking->guide->email }}</small>
                                            </div>
                                        @else
                                            <span class="text-muted">
                                                <i class="fas fa-user-times me-1"></i>
                                                Unassigned
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('admin.bookings.show', $booking) }}" 
                                               class="btn btn-sm btn-outline-primary" 
                                               title="View Details">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.bookings.edit', $booking) }}" 
                                               class="btn btn-sm btn-outline-warning" 
                                               title="Edit Booking">
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
                                                                    <i class="fas fa-check me-1"></i> Approve & Mark Paid
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
                                                                    <i class="fas fa-times me-1"></i> Cancel & Refund
                                                                </button>
                                                            </form>
                                                        </li>
                                                    @endif
                                                </ul>
                                            </div>
                                            
                                            <form action="{{ route('admin.bookings.destroy', $booking) }}" 
                                                  method="POST" 
                                                  class="d-inline"
                                                  onsubmit="return confirm('Are you sure you want to delete this booking? This action cannot be undone.')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="btn btn-sm btn-outline-danger" 
                                                        title="Delete Booking">
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
                
                <!-- Pagination -->
                <div class="d-flex justify-content-center mt-4">
                    {{ $bookings->appends(request()->query())->links('pagination::bootstrap-4') }}
                </div>
            @else
                <div class="text-center py-5">
                    <i class="fas fa-calendar-times fa-4x text-muted mb-3"></i>
                    <h5>No bookings found</h5>
                    <p class="text-muted">No bookings match your current search criteria.</p>
                    <a href="{{ route('admin.bookings.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus me-1"></i>
                        Add New Booking
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>

<script>
// Auto-submit form when filters change
document.addEventListener('DOMContentLoaded', function() {
    const filterInputs = document.querySelectorAll('select[name="status"], select[name="payment_status"], input[name="date_from"], input[name="date_to"]');
    const searchInput = document.getElementById('search');
    const form = document.querySelector('form[method="GET"]');
    let searchTimeout;
    
    // Auto-submit for dropdown filters
    filterInputs.forEach(input => {
        input.addEventListener('change', function() {
            showLoading();
            this.closest('form').submit();
        });
    });
    
    // Debounced search
    searchInput.addEventListener('input', function() {
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(() => {
            if (this.value.length >= 2 || this.value.length === 0) {
                showLoading();
                this.closest('form').submit();
            }
        }, 500);
    });
    
    // Show loading indicator
    function showLoading() {
        const table = document.querySelector('.table-responsive');
        if (table) {
            table.style.opacity = '0.6';
            table.style.pointerEvents = 'none';
        }
    }
    
    // Clear search on clear button click
    document.querySelector('a[href="{{ route("admin.bookings.index") }}"]').addEventListener('click', function(e) {
        e.preventDefault();
        searchInput.value = '';
        document.querySelector('select[name="status"]').value = '';
        document.querySelector('select[name="payment_status"]').value = '';
        document.querySelector('input[name="date_from"]').value = '';
        document.querySelector('input[name="date_to"]').value = '';
        showLoading();
        form.submit();
    });
    
    // Add loading state to export buttons
    document.querySelectorAll('.dropdown-menu a').forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            this.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i> Exporting...';
            // Add actual export functionality here
            setTimeout(() => {
                this.innerHTML = '<i class="fas fa-file-csv me-1"></i> Export CSV';
            }, 2000);
        });
    });
});
</script>
@endsection 