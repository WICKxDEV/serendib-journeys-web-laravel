@extends('layouts.guide')

@section('content')
<div class="container">
    <h1 class="mb-4">My Assigned Bookings</h1>
    @if($bookings->isEmpty())
        <p>No bookings assigned yet.</p>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Tour</th>
                    <th>Customer</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Guests</th>
                </tr>
            </thead>
            <tbody>
                @foreach($bookings as $booking)
                <tr>
                    <td>{{ $booking->tour->title }}</td>
                    <td>
                        {{ $booking->user->name ?? $booking->guest_name ?? 'Guest' }}<br>
                        <small>{{ $booking->user->email ?? $booking->guest_email ?? '' }}</small>
                    </td>
                    <td>{{ $booking->booking_date }}</td>
                    <td>{{ ucfirst($booking->status) }}</td>
                    <td>{{ $booking->guests }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection 