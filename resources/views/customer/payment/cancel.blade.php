@extends('layouts.customer')

@section('title', 'Payment Cancelled')

@section('content')
<div class="container-xxl py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 text-center">
                <div class="card shadow">
                    <div class="card-body">
                        <div class="mb-4">
                            <i class="fas fa-times-circle" style="font-size: 4rem; color: #3db320;"></i>
                        </div>
                        
                        <h2 class="mb-3" style="color: #3db320;">Payment Cancelled</h2>
                        
                        <p class="lead mb-4">
                            Your payment was not completed. This could be due to insufficient funds, card issues, or you cancelled the payment.
                        </p>
                        
                        <div class="alert alert-warning">
                            <i class="fas fa-exclamation-triangle"></i>
                            Don't worry, no charges were made to your account. You can try the payment again or contact us for assistance.
                        </div>
                        
                        <div class="mt-4">
                            <a href="{{ route('packages') }}" class="btn btn-primary me-2" style="background:#3db320; border-color:#3db320;">
                                <i class="fas fa-arrow-left"></i> Back to Tours
                            </a>
                            <a href="{{ route('contact') }}" class="btn btn-outline-primary" style="color:#3db320; border-color:#3db320;">
                                <i class="fas fa-phone"></i> Contact Support
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 