@extends('layouts.customer')

@section('title', 'Book Tour')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">
                        <i class="fas fa-calendar-plus me-2"></i>
                        Book Tour
                    </h4>
                </div>
                <div class="card-body">
                    @if($tour)
                        {{-- Tour Information --}}
                        <div class="row mb-4">
                            <div class="col-md-4">
                                @if($tour->images_array && count($tour->images_array) > 0)
                                    <img src="{{ $tour->image_url }}" alt="{{ $tour->title }}" 
                                         class="img-fluid rounded" style="width: 100%; height: 200px; object-fit: cover;">
                                @else
                                    <img src="{{ asset('img/default-tour.jpg') }}" alt="{{ $tour->title }}" 
                                         class="img-fluid rounded" style="width: 100%; height: 200px; object-fit: cover;">
                                @endif
                            </div>
                            <div class="col-md-8">
                                <h5>{{ $tour->title }}</h5>
                                <p class="text-muted">{{ $tour->destination->name }}</p>
                                <p class="mb-2">{{ Str::limit($tour->description, 150) }}</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="h4 text-primary mb-0">${{ number_format($tour->price, 2) }}</span>
                                    <span class="text-muted">per person</span>
                                </div>
                            </div>
                        </div>

                        {{-- Booking Form --}}
                        <form action="{{ route('customer.bookings.store', $tour) }}" method="POST">
                            @csrf
                            <input type="hidden" name="tour_id" value="{{ $tour->id }}">

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="guests" class="form-label">
                                        <i class="fas fa-users me-1"></i>
                                        Number of Guests
                                    </label>
                                    <input type="number" name="guests" id="guests" min="1" value="1" required 
                                           class="form-control @error('guests') is-invalid @enderror">
                                    @error('guests')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="booking_date" class="form-label">
                                        <i class="fas fa-calendar me-1"></i>
                                        Preferred Date
                                    </label>
                                    <input type="date" name="booking_date" id="booking_date" 
                                           min="{{ date('Y-m-d') }}" required 
                                           class="form-control @error('booking_date') is-invalid @enderror">
                                    @error('booking_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="guest_name" class="form-label">
                                    <i class="fas fa-user me-1"></i>
                                    Guest Name
                                </label>
                                <input type="text" name="guest_name" id="guest_name" 
                                       value="{{ auth()->user()->name }}" required 
                                       class="form-control @error('guest_name') is-invalid @enderror">
                                @error('guest_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="guest_email" class="form-label">
                                        <i class="fas fa-envelope me-1"></i>
                                        Email Address
                                    </label>
                                    <input type="email" name="guest_email" id="guest_email" 
                                           value="{{ auth()->user()->email }}" required 
                                           class="form-control @error('guest_email') is-invalid @enderror">
                                    @error('guest_email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="guest_phone" class="form-label">
                                        <i class="fas fa-phone me-1"></i>
                                        Phone Number
                                    </label>
                                    <input type="tel" name="guest_phone" id="guest_phone" 
                                           class="form-control @error('guest_phone') is-invalid @enderror">
                                    @error('guest_phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="special_requests" class="form-label">
                                    <i class="fas fa-comment me-1"></i>
                                    Special Requests (Optional)
                                </label>
                                <textarea name="special_requests" id="special_requests" rows="3" 
                                          class="form-control @error('special_requests') is-invalid @enderror"
                                          placeholder="Any special requirements or requests..."></textarea>
                                @error('special_requests')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Price Calculation --}}
                            <div class="card bg-light mb-3">
                                <div class="card-body">
                                    <h6 class="card-title">Price Breakdown</h6>
                                    <div class="row">
                                        <div class="col-6">
                                            <span>Price per person:</span>
                                        </div>
                                        <div class="col-6 text-end">
                                            <span>${{ number_format($tour->price, 2) }}</span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <span>Number of guests:</span>
                                        </div>
                                        <div class="col-6 text-end">
                                            <span id="guest-count">1</span>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-6">
                                            <strong>Total:</strong>
                                        </div>
                                        <div class="col-6 text-end">
                                            <strong id="total-price">${{ number_format($tour->price, 2) }}</strong>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between">
                                <a href="{{ route('tours.show', $tour) }}" class="btn btn-outline-secondary">
                                    <i class="fas fa-arrow-left me-1"></i>
                                    Back to Tour
                                </a>
                                <div>
                                    <button type="submit" class="btn btn-primary me-2">
                                        <i class="fas fa-calendar-check me-1"></i>
                                        Book Now
                                    </button>
                                    <a href="{{ route('customer.payment.checkout', $tour) }}" class="btn btn-success">
                                        <i class="fas fa-credit-card me-1"></i>
                                        Pay & Book
                                    </a>
                                </div>
                            </div>
                        </form>
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-exclamation-triangle fa-3x text-warning mb-3"></i>
                            <h5>No Tour Selected</h5>
                            <p class="text-muted">Please select a tour to book.</p>
                            <a href="{{ route('packages') }}" class="btn btn-primary">
                                <i class="fas fa-search me-1"></i>
                                Browse Tours
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Update price calculation when guests change
    document.getElementById('guests').addEventListener('change', function() {
        const guests = parseInt(this.value);
        const pricePerPerson = {{ $tour ? $tour->price : 0 }};
        const total = guests * pricePerPerson;
        
        document.getElementById('guest-count').textContent = guests;
        document.getElementById('total-price').textContent = '$' + total.toFixed(2);
    });
</script>
@endsection 