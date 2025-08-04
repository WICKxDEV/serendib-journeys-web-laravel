@extends('layouts.app')

@section('title', $tour->title)

@section('content')
    {{-- Tour Detail Content --}}
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    {{-- Tour Images --}}
                    @if($tour->images_array && count($tour->images_array) > 0)
                        <div class="mb-4">
                            <div id="tourCarousel" class="carousel slide" data-bs-ride="carousel">
                                <div class="carousel-indicators">
                                    @foreach($tour->image_urls as $index => $imageUrl)
                                        <button type="button" data-bs-target="#tourCarousel" data-bs-slide-to="{{ $index }}" 
                                                class="{{ $index === 0 ? 'active' : '' }}" aria-current="{{ $index === 0 ? 'true' : 'false' }}" 
                                                aria-label="Slide {{ $index + 1 }}"></button>
                                    @endforeach
                                </div>
                                <div class="carousel-inner">
                                    @foreach($tour->image_urls as $index => $imageUrl)
                                        <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                            <img src="{{ $imageUrl }}" class="d-block w-100" alt="Tour image {{ $index + 1 }}" style="height: 400px; object-fit: cover;">
                                        </div>
                                    @endforeach
                                </div>
                                <button class="carousel-control-prev" type="button" data-bs-target="#tourCarousel" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#tourCarousel" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div>
                        </div>
                    @endif

                    {{-- Tour Information --}}
                    <div class="mb-4">
                        <h1 class="mb-3">{{ $tour->title }}</h1>
                        <div class="d-flex align-items-center mb-3">
                            <span class="badge bg-primary me-2">{{ $tour->destination->name }}</span>
                            <span class="text-muted">Duration: {{ $tour->available_from->diffForHumans($tour->available_to) }}</span>
                        </div>
                        <p class="lead">{{ $tour->description }}</p>
                    </div>

                    {{-- Itinerary --}}
                    <div class="mb-4">
                        <h3>Itinerary</h3>
                        <div class="card">
                            <div class="card-body">
                                {!! nl2br(e($tour->itinerary)) !!}
                            </div>
                        </div>
                    </div>

                    {{-- Travel Guides Section --}}
                    @include('common.travel-guide')

                    {{-- Reviews Section --}}
                    <div class="mb-4">
                        <h3>Reviews ({{ $tour->reviews->count() }})</h3>

                        {{-- Display existing reviews --}}
                        @forelse($tour->reviews as $review)
                            <div class="d-flex align-items-start mb-4">
                                <img class="img-fluid flex-shrink-0 rounded-circle" src="https://via.placeholder.com/50" alt="User Image" style="width: 50px; height: 50px;">
                                <div class="ms-3">
                                    <div class="d-flex justify-content-between">
                                        <h6 class="mb-1">{{ $review->user->name ?? 'Guest' }}</h6>
                                        <div>
                                            @for ($i = 1; $i <= 5; $i++)
                                                <i class="fa fa-star{{ $i <= $review->rating ? '' : '-o' }} text-primary"></i>
                                            @endfor
                                        </div>
                                    </div>
                                    <small class="text-muted">{{ $review->created_at->diffForHumans() }}</small>
                                    <p class="mt-2">{{ $review->comment }}</p>
                                </div>
                            </div>
                        @empty
                            <p>No reviews yet. Be the first to review this tour!</p>
                        @endforelse

                        <hr class="my-4">

                        {{-- Review Submission Form --}}
                        @auth
                            @if(auth()->user()->bookings()->where('tour_id', $tour->id)->where('status', 'approved')->exists() && !auth()->user()->reviews()->where('tour_id', $tour->id)->exists())
                                <h4 class="mb-3">Write a Review</h4>
                                @if(session('success'))
                                    <div class="alert alert-success">{{ session('success') }}</div>
                                @endif
                                @if(session('error'))
                                    <div class="alert alert-danger">{{ session('error') }}</div>
                                @endif
                                <form action="{{ route('customer.reviews.store', $tour) }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="rating" class="form-label">Your Rating</label>
                                        <div class="rating">
                                            {{-- Simple star rating --}}
                                            <input type="radio" name="rating" id="rating5" value="5" required><label for="rating5">☆</label>
                                            <input type="radio" name="rating" id="rating4" value="4"><label for="rating4">☆</label>
                                            <input type="radio" name="rating" id="rating3" value="3"><label for="rating3">☆</label>
                                            <input type="radio" name="rating" id="rating2" value="2"><label for="rating2">☆</label>
                                            <input type="radio" name="rating" id="rating1" value="1"><label for="rating1">☆</label>
                                        </div>
                                        @error('rating') <div class="text-danger">{{ $message }}</div> @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="comment" class="form-label">Your Review</label>
                                        <textarea class="form-control" id="comment" name="comment" rows="4" required>{{ old('comment') }}</textarea>
                                        @error('comment') <div class="text-danger">{{ $message }}</div> @enderror
                                    </div>
                                    <button type="submit" class="btn btn-primary">Submit Review</button>
                                </form>
                            @elseif(auth()->user()->reviews()->where('tour_id', $tour->id)->exists())
                                <p class="text-muted">You have already submitted a review for this tour. Thank you!</p>
                            @else
                                 <p class="text-muted">You must complete this tour before you can write a review.</p>
                            @endif
                        @else
                            <p>Please <a href="{{ route('login') }}">log in</a> to write a review.</p>
                        @endauth
                    </div>
                </div>

                {{-- Booking Sidebar --}}
                <div class="col-lg-4">
                    <div class="card sticky-top" style="top: 20px;">
                        <div class="card-body">
                            <h5 class="card-title">Book This Tour</h5>
                            <div class="mb-3">
                                <h3 class="text-primary">${{ number_format($tour->price, 2) }}</h3>
                                <small class="text-muted">per person</small>
                            </div>
                            
                            @auth
                                <form action="{{ route('customer.booking.create', $tour) }}" method="GET">
                                    <div class="mb-3">
                                        <label for="guests" class="form-label">Number of Guests</label>
                                        <input type="number" name="guests" id="guests" min="1" value="1" required class="form-control">
                                    </div>
                                    <button type="submit" class="btn btn-primary w-100 mb-2">Book Now</button>
                                </form>
                                
                                <form action="{{ route('customer.payment.checkout', $tour) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="guests" value="1" id="payment-guests">
                                    <button type="submit" class="btn btn-success w-100">Pay & Book Now</button>
                                </form>
                            @else
                                <p class="text-muted">Please <a href="{{ route('login') }}">log in</a> to book this tour.</p>
                                <a href="{{ route('login') }}" class="btn btn-primary w-100">Login to Book</a>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
    .rating {
        display: flex;
        flex-direction: row-reverse;
        justify-content: flex-end;
    }

    .rating > input{ display:none;}

    .rating > label {
        position: relative;
        width: 1em;
        font-size: 2rem;
        color: #FFD600;
        cursor: pointer;
    }
    .rating > label::before{
        content: "\\2605";
        position: absolute;
        opacity: 0;
    }
    .rating > label:hover:before,
    .rating > label:hover ~ label:before {
        opacity: 1 !important;
    }

    .rating > input:checked ~ label:before{
        opacity:1;
    }

    .rating:hover > input:checked ~ label:before{ opacity: 0.4; }
    </style>

    <script>
        // Sync guests input for payment form
        document.getElementById('guests').addEventListener('change', function() {
            document.getElementById('payment-guests').value = this.value;
        });
    </script>
@endsection

