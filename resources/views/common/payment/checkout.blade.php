@extends('layouts.app')
@section('content')
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>{{ \App\Helpers\SettingsHelper::get('site_title', 'Serendib Journeys - Explore Sri Lanka with Expert Tour Guides') }}</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta
      content="{{ \App\Helpers\SettingsHelper::get('seo_keywords', 'Sri Lanka tours, expert tour guide, Ceylon travel, tourism') }}"
      name="keywords"
    />
    <meta
      content="{{ \App\Helpers\SettingsHelper::get('seo_description', 'Discover the beauty of Sri Lanka with Serendib Journeys, the top tour guide service. Personalized itineraries, transport, and accommodations.') }}"
      name="description"
    />

    <!-- Favicon -->
    <link
      rel="apple-touch-icon"
      sizes="180x180"
      href="img/favicon_io/apple-touch-icon.png"
    />
    <link
      rel="icon"
      type="image/png"
      sizes="32x32"
      href="img/favicon_io/favicon-32x32.ico"
    />
    <link
      rel="icon"
      type="image/png"
      sizes="16x16"
      href="img/favicon_io/favicon-16x16.ico"
    />
    <link rel="manifest" href="img/favicon_io/site.webmanifest" />

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Nunito:wght@600;700;800&display=swap"
      rel="stylesheet"
    />

    <!-- Icon Font Stylesheet -->
    <link
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css"
      rel="stylesheet"
    />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css"
      rel="stylesheet"
    />

    <link
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
      rel="stylesheet"
    />

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet" />
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet" />
    <link
      href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css"
      rel="stylesheet"
    />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet" />

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet" />
  </head>
  <body>

    <!-- Topbar Start -->
    <div class="container-fluid bg-dark px-5 d-none d-lg-block">
      <div class="row gx-0">
        <div class="col-lg-8 text-center text-lg-start mb-2 mb-lg-0">
          <div class="d-inline-flex align-items-center" style="height: 45px">
            <small class="me-3 text-light"
              ><i class="fa fa-map-marker-alt me-2"></i> {{ \App\Helpers\SettingsHelper::get('address', 'Sigiriya, Sri Lanka') }}</small
            >
            <small class="me-3 text-light"
              ><i class="fa fa-phone-alt me-2"></i>{{ \App\Helpers\SettingsHelper::get('phone', '+94 70 7777 364') }}</small
            >
            <small class="text-light"
              ><i class="fa fa-envelope-open me-2"></i>{{ \App\Helpers\SettingsHelper::get('email', 'info@serendibjourneys.lk') }}</small
            >
          </div>
        </div>
        <div class="col-lg-4 text-center text-lg-end">
          <div class="d-inline-flex align-items-center" style="height: 45px">
            @if(\App\Helpers\SettingsHelper::get('social_instagram'))
            <a
              class="btn btn-sm btn-outline-light btn-sm-square rounded-circle me-2"
              href="{{ \App\Helpers\SettingsHelper::get('social_instagram') }}"
              target="_blank"
              rel="noopener noreferrer"
              ><i class="fab fa-instagram fw-normal"></i
            ></a>
            @endif
            @if(\App\Helpers\SettingsHelper::get('social_facebook'))
            <a
              class="btn btn-sm btn-outline-light btn-sm-square rounded-circle me-2"
              href="{{ \App\Helpers\SettingsHelper::get('social_facebook') }}"
              target="_blank"
              rel="noopener noreferrer"
              ><i class="fab fa-facebook-f fw-normal"></i
            ></a>
            @endif
            @if(\App\Helpers\SettingsHelper::get('social_tiktok'))
            <a
              class="btn btn-sm btn-outline-light btn-sm-square rounded-circle me-2"
              href="{{ \App\Helpers\SettingsHelper::get('social_tiktok') }}"
              target="_blank"
              rel="noopener noreferrer"
              ><i class="fab fa-tiktok fw-normal"></i
            ></a>
            @endif
            @if(\App\Helpers\SettingsHelper::get('social_whatsapp'))
            <a
              class="btn btn-sm btn-outline-light btn-sm-square rounded-circle me-2"
              href="{{ \App\Helpers\SettingsHelper::get('social_whatsapp') }}"
              target="_blank"
              rel="noopener noreferrer"
              ><i class="fab fa-whatsapp fw-normal"></i
            ></a>
            @endif
            @if(\App\Helpers\SettingsHelper::get('social_youtube'))
            <a
              class="btn btn-sm btn-outline-light btn-sm-square rounded-circle"
              href="{{ \App\Helpers\SettingsHelper::get('social_youtube') }}"
              target="_blank"
              rel="noopener noreferrer"
              ><i class="fab fa-youtube fw-normal"></i
            ></a>
            @endif
          </div>
        </div>
      </div>
    </div>
    <!-- Topbar End -->

<!-- Navbar & Hero Start -->
<div class="container-fluid position-relative p-0">
      <nav
        class="navbar navbar-expand-lg navbar-light px-4 px-lg-5 py-3 py-lg-0"
      >
        <a href="{{ route('home') }}" class="navbar-brand p-0">
          <img src="img/logo-min.png" alt="Logo" />
        </a>
        <h2 class="text-primary-new-top m-0">{{ \App\Helpers\SettingsHelper::get('site_name', 'Serendib Journeys') }}</h2>
        <button
          class="navbar-toggler sticky-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarCollapse"
        >
          <span class="fa fa-bars"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
          <div class="navbar-nav ms-auto py-0">
            <a href="{{ route('home') }}" class="nav-item nav-link {{ request()->routeIs('home') ? 'active' : '' }}">Home</a>
            <a href="{{ route('about') }}" class="nav-item nav-link {{ request()->routeIs('about') ? 'active' : '' }}">About</a>
            <a href="{{ route('services') }}" class="nav-item nav-link {{ request()->routeIs('services') ? 'active' : '' }}">Services</a>
            <a href="{{ route('packages') }}" class="nav-item nav-link {{ request()->routeIs('booking') ? 'active' : '' }}">Packages</a>
            <a href="{{ route('booking.form') }}" class="nav-item nav-link {{ request()->routeIs('booking.form') ? 'active' : '' }}">Booking</a>
            <a href="{{ route('gallery') }}" class="nav-item nav-link {{ request()->routeIs('gallery') ? 'active' : '' }}">Gallery</a>
            <a href="{{ route('contact') }}" class="nav-item nav-link {{ request()->routeIs('contact') ? 'active' : '' }}">Contact</a>
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}" class="nav-item nav-link">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="nav-item nav-link">Log in</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="nav-item nav-link">Register</a>
                    @endif
                @endauth
            @endif
          </div>
        </div>
      </nav>

      
    </div>
    <!-- Elfsight WhatsApp Chat | Untitled WhatsApp Chat -->
    <script src="https://static.elfsight.com/platform/platform.js" async></script>
    <div class="elfsight-app-d84f2d3d-6afc-4b32-8691-cad69420693e" data-elfsight-app-lazy></div>
    <!-- Navbar & Hero End -->

<!-- Hero/Header Section -->
<div class="container-fluid bg-primary py-5 mb-5 hero-header">
    <div class="container py-5">
        <div class="row justify-content-center py-5">
            <div class="col-lg-10 pt-lg-5 mt-lg-5 text-center">
                <h1 class="display-3 text-white animated slideInDown text-primary-new">
                    Complete Your Booking
                </h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center">
                        <li class="breadcrumb-item">
                            <a class="text-white" href="{{ route('home') }}">Home</a>
                        </li>
                        <li class="breadcrumb-item text-white active" aria-current="page">
                            Payment
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- Main Content -->
<div class="container-xxl py-5 wow fadeInUp" data-wow-delay="0.1s">
    <div class="container">
        <div class="booking p-5">
            <div class="row g-5 align-items-center justify-content-center">
                <div class="col-md-8">
                    <div class="card shadow rounded-lg border-0" style="border-top: 4px solid #3db320;">
                        <div class="card-header text-white" style="background: #3db320; border-top-left-radius: .5rem; border-top-right-radius: .5rem;">
                            <h5 class="mb-0 fw-bold">Booking Invoice</h5>
                        </div>
                        <div class="card-body p-4">
                            <table class="table table-bordered mb-4">
                                <tbody>
                                    <tr>
                                        <th>Name</th>
                                        <td>{{ $booking->guest_name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Email</th>
                                        <td>{{ $booking->guest_email }}</td>
                                    </tr>
                                    <tr>
                                        <th>Phone</th>
                                        <td>{{ $booking->guest_phone }}</td>
                                    </tr>
                                    <tr>
                                        <th>Tour</th>
                                        <td>{{ $tour->title }}</td>
                                    </tr>
                                    <tr>
                                        <th>Date</th>
                                        <td>{{ $booking->booking_date }}</td>
                                    </tr>
                                    <tr>
                                        <th>Guests</th>
                                        <td>{{ $booking->guests }}</td>
                                    </tr>
                                    <tr>
                                        <th>Total Price</th>
                                        <td><strong style="color:#3db320;">${{ $booking->total_price }}</strong></td>
                                    </tr>
                                </tbody>
                            </table>
                            <hr>
                            <h5 class="fw-bold" style="color:#3db320;">Payment</h5>
                            <form id="payment-form">
                                <div id="payment-element"></div>
                                <button id="submit-payment" class="btn btn-primary mt-3 w-100" style="background:#3db320; border-color:#3db320; font-weight:600;">Pay Now</button>
                                <div id="payment-message" class="mt-3"></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
<script src="https://js.stripe.com/v3/"></script>
<script>
    const stripe = Stripe(@json($stripeKey));
    const options = {
        clientSecret: @json($paymentIntent->client_secret),
    };
    const elements = stripe.elements(options);
    const paymentElement = elements.create('payment');
    paymentElement.mount('#payment-element');
    const form = document.getElementById('payment-form');
    form.addEventListener('submit', async function(event) {
        event.preventDefault();
        document.getElementById('submit-payment').disabled = true;
        const {error} = await stripe.confirmPayment({
            elements,
            confirmParams: {
                return_url: '{{ route('booking.payment.success', ['booking_id' => $booking->id]) }}',
            },
        });
        if (error) {
            document.getElementById('payment-message').textContent = error.message;
            document.getElementById('submit-payment').disabled = false;
        }
    });
</script>
<style>
.btn-primary {
    background: #3db320 !important;
    border-color: #3db320 !important;
}
.btn-primary:hover, .btn-primary:focus {
    background: #31991a !important;
    border-color: #31991a !important;
}
</style>
@endsection 