@extends('layouts.customer')

@section('content')
<div class="container mx-auto">
    <h1 class="text-2xl mb-4">Booking Details</h1>
    <div class="mb-4">
        <strong>Tour:</strong> {{ $booking->tour->title }}<br>
        <strong>Date:</strong> {{ $booking->booking_date }}<br>
        <strong>Status:</strong> {{ ucfirst($booking->status) }}<br>
        <strong>Total:</strong> ${{ $booking->total_price }}<br>
        <strong>Guests:</strong> {{ $booking->guests }}<br>
        <strong>Guide:</strong> {{ $booking->guide ? $booking->guide->name : 'Unassigned' }}<br>
    </div>
    @if(in_array($booking->status, ['pending', 'approved']))
        <form action="{{ route('customer.bookings.cancel', $booking) }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-danger" onclick="return confirm('Cancel this booking?')">Cancel Booking</button>
        </form>
    @endif
    <a href="{{ route('customer.bookings.index') }}" class="btn btn-secondary mt-2">Back to My Bookings</a>
</div>
@endsection 