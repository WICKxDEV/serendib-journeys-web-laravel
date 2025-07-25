@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    Welcome, Guest!
                </div>
                <div class="card-body">
                    <h3 class="mb-3">Thank you for booking with us!</h3>
                    <p class="mb-4">You can explore more tours or make another booking below.</p>
                    <a href="{{ route('booking.form') }}" class="btn btn-success">Book Another Tour</a>
                    <a href="{{ route('home') }}" class="btn btn-outline-primary ml-2">Back to Home</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 