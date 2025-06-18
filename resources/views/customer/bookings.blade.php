@extends('layouts.customer')

@section('content')
<div class="container mx-auto">
    <h1 class="text-2xl mb-4">My Bookings</h1>
    @if($bookings->isEmpty())
        <p>No bookings yet.</p>
    @else
        <table class="table-auto w-full mt-4">
            <thead>
                <tr>
                    <th>Tour</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($bookings as $booking)
                <tr>
                    <td>{{ $booking->tour->title }}</td>
                    <td>{{ $booking->created_at->format('Y-m-d') }}</td>
                    <td>{{ ucfirst($booking->status) }}</td>
                    <td>${{ $booking->total_price }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
