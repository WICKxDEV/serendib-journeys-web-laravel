@extends('layouts.customer')

@section('title', 'Payment Successful')

@section('content')
<div class="container-xxl py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 text-center">
                <div class="card shadow">
                    <div class="card-body">
                        <div class="mb-4">
                            <i class="fas fa-check-circle" style="font-size: 4rem; color: #3db320;"></i>
                        </div>
                        
                        <h2 class="mb-3" style="color: #3db320;">Payment Successful!</h2>
                        
                        <p class="lead mb-4">
                            Thank you for your booking. Your payment has been processed successfully and your tour has been confirmed.
                        </p>
                        
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle"></i>
                            You will receive a confirmation email shortly with all the details of your booking.
                        </div>
                        
                        <div class="mt-4">
                            <a href="{{ route('customer.bookings.index') }}" class="btn btn-primary me-2" style="background:#3db320; border-color:#3db320;">
                                <i class="fas fa-list"></i> View My Bookings
                            </a>
                            <a href="{{ route('packages') }}" class="btn btn-outline-primary" style="color:#3db320; border-color:#3db320;">
                                <i class="fas fa-search"></i> Browse More Tours
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 