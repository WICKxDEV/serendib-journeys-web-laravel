@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">
                        <i class="fas fa-edit me-2"></i>
                        Edit Booking
                    </h4>
                    <a href="{{ route('admin.bookings.index') }}" class="btn btn-outline-secondary btn-sm">
                        <i class="fas fa-arrow-left me-1"></i>
                        Back to Bookings
                    </a>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.bookings.update', $booking) }}" method="POST">
                        @csrf 
                        @method('PUT')
                        
                        <!-- Booking Information Display -->
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
                                        <p class="mb-0"><strong>Last Updated:</strong> {{ $booking->updated_at->format('M d, Y \a\t g:i A') }}</p>
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

                        <div class="row">
                            <!-- Customer Selection -->
                            <div class="col-md-6 mb-3">
                                <label for="user_id" class="form-label">
                                    <i class="fas fa-user me-1"></i>
                                    Customer *
                                </label>
                                <select name="user_id" id="user_id" class="form-select @error('user_id') is-invalid @enderror" required>
                                    <option value="">Select Customer</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}" {{ old('user_id', $booking->user_id) == $user->id ? 'selected' : '' }}>
                                            {{ $user->name }} ({{ $user->email }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('user_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text">
                                    <i class="fas fa-info-circle me-1"></i>
                                    Select the customer for this booking.
                                </div>
                            </div>

                            <!-- Tour Selection -->
                            <div class="col-md-6 mb-3">
                                <label for="tour_id" class="form-label">
                                    <i class="fas fa-map-marked-alt me-1"></i>
                                    Tour *
                                </label>
                                <select name="tour_id" id="tour_id" class="form-select @error('tour_id') is-invalid @enderror" required>
                                    <option value="">Select Tour</option>
                                    @foreach($tours as $tour)
                                        <option value="{{ $tour->id }}" {{ old('tour_id', $booking->tour_id) == $tour->id ? 'selected' : '' }}>
                                            {{ $tour->title }} - {{ $tour->destination->name }} (${{ number_format($tour->price, 2) }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('tour_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text">
                                    <i class="fas fa-info-circle me-1"></i>
                                    Select the tour for this booking.
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <!-- Booking Date -->
                            <div class="col-md-4 mb-3">
                                <label for="booking_date" class="form-label">
                                    <i class="fas fa-calendar me-1"></i>
                                    Booking Date *
                                </label>
                                <input type="date" name="booking_date" id="booking_date" 
                                       value="{{ old('booking_date', $booking->booking_date->format('Y-m-d')) }}" 
                                       class="form-control @error('booking_date') is-invalid @enderror" required>
                                @error('booking_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Number of Guests -->
                            <div class="col-md-4 mb-3">
                                <label for="guests" class="form-label">
                                    <i class="fas fa-users me-1"></i>
                                    Number of Guests *
                                </label>
                                <input type="number" name="guests" id="guests" 
                                       value="{{ old('guests', $booking->guests) }}" 
                                       class="form-control @error('guests') is-invalid @enderror" 
                                       min="1" max="50" required>
                                @error('guests')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Total Price -->
                            <div class="col-md-4 mb-3">
                                <label for="total_price" class="form-label">
                                    <i class="fas fa-dollar-sign me-1"></i>
                                    Total Price (USD) *
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text">$</span>
                                    <input type="number" step="0.01" name="total_price" id="total_price" 
                                           value="{{ old('total_price', $booking->total_price) }}" 
                                           class="form-control @error('total_price') is-invalid @enderror" required>
                                </div>
                                @error('total_price')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <!-- Booking Status -->
                            <div class="col-md-4 mb-3">
                                <label for="status" class="form-label">
                                    <i class="fas fa-tasks me-1"></i>
                                    Booking Status *
                                </label>
                                <select name="status" id="status" class="form-select @error('status') is-invalid @enderror" required>
                                    <option value="">Select Status</option>
                                    <option value="pending" {{ old('status', $booking->status) == 'pending' ? 'selected' : '' }}>
                                        ⏳ Pending
                                    </option>
                                    <option value="approved" {{ old('status', $booking->status) == 'approved' ? 'selected' : '' }}>
                                        ✅ Approved
                                    </option>
                                    <option value="cancelled" {{ old('status', $booking->status) == 'cancelled' ? 'selected' : '' }}>
                                        ❌ Cancelled
                                    </option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Payment Status -->
                            <div class="col-md-4 mb-3">
                                <label for="payment_status" class="form-label">
                                    <i class="fas fa-credit-card me-1"></i>
                                    Payment Status *
                                </label>
                                <select name="payment_status" id="payment_status" class="form-select @error('payment_status') is-invalid @enderror" required>
                                    <option value="">Select Payment Status</option>
                                    <option value="unpaid" {{ old('payment_status', $booking->payment_status) == 'unpaid' ? 'selected' : '' }}>
                                        💳 Unpaid
                                    </option>
                                    <option value="paid" {{ old('payment_status', $booking->payment_status) == 'paid' ? 'selected' : '' }}>
                                        ✅ Paid
                                    </option>
                                    <option value="refunded" {{ old('payment_status', $booking->payment_status) == 'refunded' ? 'selected' : '' }}>
                                        💰 Refunded
                                    </option>
                                </select>
                                @error('payment_status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Guide Assignment -->
                            <div class="col-md-4 mb-3">
                                <label for="guide_id" class="form-label">
                                    <i class="fas fa-user-tie me-1"></i>
                                    Assign Guide
                                </label>
                                <select name="guide_id" id="guide_id" class="form-select @error('guide_id') is-invalid @enderror">
                                    <option value="">-- Unassigned --</option>
                                    @foreach($guides as $guide)
                                        <option value="{{ $guide->id }}" {{ old('guide_id', $booking->guide_id) == $guide->id ? 'selected' : '' }}>
                                            {{ $guide->name }} ({{ $guide->email }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('guide_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text">
                                    <i class="fas fa-info-circle me-1"></i>
                                    Optional: Assign a tour guide to this booking.
                                </div>
                            </div>
                        </div>

                        <!-- Guest Information (for non-registered users) -->
                        @if($booking->guest_name || $booking->guest_email)
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="guest_name" class="form-label">
                                    <i class="fas fa-user me-1"></i>
                                    Guest Name
                                </label>
                                <input type="text" name="guest_name" id="guest_name" 
                                       value="{{ old('guest_name', $booking->guest_name) }}" 
                                       class="form-control @error('guest_name') is-invalid @enderror">
                                @error('guest_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="guest_email" class="form-label">
                                    <i class="fas fa-envelope me-1"></i>
                                    Guest Email
                                </label>
                                <input type="email" name="guest_email" id="guest_email" 
                                       value="{{ old('guest_email', $booking->guest_email) }}" 
                                       class="form-control @error('guest_email') is-invalid @enderror">
                                @error('guest_email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="guest_phone" class="form-label">
                                    <i class="fas fa-phone me-1"></i>
                                    Guest Phone
                                </label>
                                <input type="tel" name="guest_phone" id="guest_phone" 
                                       value="{{ old('guest_phone', $booking->guest_phone) }}" 
                                       class="form-control @error('guest_phone') is-invalid @enderror">
                                @error('guest_phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        @endif

                        <!-- Special Requests -->
                        <div class="mb-3">
                            <label for="special_requests" class="form-label">
                                <i class="fas fa-comment me-1"></i>
                                Special Requests
                            </label>
                            <textarea name="special_requests" id="special_requests" rows="3" 
                                      class="form-control @error('special_requests') is-invalid @enderror" 
                                      placeholder="Enter any special requests or notes...">{{ old('special_requests', $booking->special_requests) }}</textarea>
                            @error('special_requests')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">
                                <i class="fas fa-info-circle me-1"></i>
                                Optional: Add any special requests or notes for this booking.
                            </div>
                        </div>

                        <!-- Form Actions -->
                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('admin.bookings.index') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-times me-1"></i>
                                Cancel
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-1"></i>
                                Update Booking
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Auto-calculate total price when tour or guests change
document.addEventListener('DOMContentLoaded', function() {
    const tourSelect = document.getElementById('tour_id');
    const guestsInput = document.getElementById('guests');
    const totalPriceInput = document.getElementById('total_price');
    
    function calculateTotal() {
        const selectedTour = tourSelect.options[tourSelect.selectedIndex];
        const guests = parseInt(guestsInput.value) || 0;
        
        if (selectedTour && selectedTour.value) {
            // Extract price from tour option text (assuming format: "Tour Name - Destination ($XX.XX)")
            const priceMatch = selectedTour.text.match(/\$([\d.]+)/);
            if (priceMatch) {
                const tourPrice = parseFloat(priceMatch[1]);
                const total = tourPrice * guests;
                totalPriceInput.value = total.toFixed(2);
            }
        }
    }
    
    tourSelect.addEventListener('change', calculateTotal);
    guestsInput.addEventListener('input', calculateTotal);
    
    // Initialize calculation
    calculateTotal();
});
</script>
@endsection 