<form action="{{ route('customer.bookings.store', $tour->id) }}" method="POST">
    @csrf
    <input type="hidden" name="tour_id" value="{{ $tour->id }}">

    <label for="guests">Number of Guests:</label>
    <input type="number" name="guests" min="1" value="1" required class="border p-2 mb-2">

    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Book Now</button>
</form>
<form action="{{ route('customer.payment.checkout', $tour->id) }}" method="POST">
    @csrf
    <input type="number" name="guests" min="1" value="1" required>
    <button type="submit">Pay & Book Now</button>
</form>

@extends('layouts.app')

@section('title', $tour->name)

@section('content')
    {{-- Tour Detail Content --}}
    <div class="container-xxl py-5">
        <div class="container">
            {{-- Tour images, description, itinerary, etc. would go here --}}
            <div class="row">
                <div class="col-lg-8">
                    <div class="mb-4">
                        <h1 class="mb-3">{{ $tour->name }}</h1>
                        <p>{{ $tour->description }}</p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Book This Tour</h5>
                            <p class="card-text">Price: ${{ number_format($tour->price, 2) }}</p>
                            <a href="#" class="btn btn-primary w-100">Book Now</a>
                        </div>
                    </div>
                </div>
            </div>

            <hr class="my-5">

            {{-- Reviews Section --}}
            <div class="row">
                <div class="col-lg-8">
                    <h2 class="mb-4">Reviews ({{ $tour->reviews->count() }})</h2>

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
@endsection

