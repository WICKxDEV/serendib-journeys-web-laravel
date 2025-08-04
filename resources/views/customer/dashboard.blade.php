@extends('layouts.customer')

@section('content')
<div class="max-w-7xl mx-auto">
    <!-- Welcome Section -->
    <div class="bg-gradient-to-r from-blue-500 to-purple-600 rounded-lg shadow-lg p-6 mb-8">
        <div class="flex items-center">
            <div class="flex-shrink-0 bg-white bg-opacity-20 rounded-full p-3 mr-4">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5.121 17.804A13.937 13.937 0 0112 15c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
            </div>
            <div>
                <h1 class="text-3xl font-bold text-white mb-1">Welcome back, {{ Auth::user()->name }}!</h1>
                <p class="text-blue-100">Manage your bookings, write reviews, and explore new adventures.</p>
            </div>
        </div>
    </div>

    <!-- Quick Stats -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0 bg-blue-100 rounded-full p-3">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Total Bookings</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $totalBookings ?? 0 }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0 bg-green-100 rounded-full p-3">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Active Bookings</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $activeBookings ?? 0 }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0 bg-yellow-100 rounded-full p-3">
                    <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Reviews Written</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $reviewsCount ?? 0 }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0 bg-purple-100 rounded-full p-3">
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1" />
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Total Spent</p>
                    <p class="text-2xl font-bold text-gray-900">${{ number_format($totalSpent ?? 0, 2) }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Recent Bookings -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-lg shadow">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h2 class="text-xl font-semibold text-gray-900">Recent Bookings</h2>
                </div>
                <div class="p-6">
                    @if(isset($recentBookings) && $recentBookings->count() > 0)
                        <div class="space-y-4">
                            @foreach($recentBookings as $booking)
                                <div class="border rounded-lg p-4 hover:bg-gray-50 transition">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0">
                                                <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                                                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                    </svg>
                                                </div>
                                            </div>
                                            <div class="ml-4">
                                                <h3 class="text-lg font-medium text-gray-900">{{ $booking->tour->title }}</h3>
                                                <p class="text-sm text-gray-600">{{ $booking->booking_date->format('M d, Y') }} • {{ $booking->guests }} guests</p>
                                                <p class="text-sm text-gray-600">${{ number_format($booking->total_price, 2) }}</p>
                                            </div>
                                        </div>
                                        <div class="flex items-center space-x-2">
                                            <span class="px-2 py-1 text-xs font-medium rounded-full 
                                                {{ $booking->status === 'approved' ? 'bg-green-100 text-green-800' : 
                                                   ($booking->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                                {{ ucfirst($booking->status) }}
                                            </span>
                                            <a href="{{ route('customer.bookings.show', $booking) }}" 
                                               class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                                View Details
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="mt-6 text-center">
                            <a href="{{ route('customer.bookings.index') }}" 
                               class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                                View All Bookings
                            </a>
                        </div>
                    @else
                        <div class="text-center py-8">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900">No bookings yet</h3>
                            <p class="mt-1 text-sm text-gray-500">Start exploring our tours and make your first booking.</p>
                            <div class="mt-6">
                                <a href="{{ route('booking.form') }}" 
                                   class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                                    Explore Tours
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Quick Actions -->
            <div class="bg-white rounded-lg shadow">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h2 class="text-xl font-semibold text-gray-900">Quick Actions</h2>
                </div>
                <div class="p-6 space-y-3">
                    <a href="{{ route('booking.form') }}" 
                       class="flex items-center p-3 rounded-lg border border-gray-200 hover:bg-blue-50 hover:border-blue-300 transition">
                        <svg class="w-5 h-5 text-blue-600 mr-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 7v4a1 1 0 001 1h3m10-5v4a1 1 0 01-1 1h-3m-4 4h4m-2 0v4m0 0H7a2 2 0 01-2-2v-2a2 2 0 012-2h10a2 2 0 012 2v2a2 2 0 01-2 2h-4z" />
                        </svg>
                        <span class="font-medium text-gray-900">Book New Tour</span>
                    </a>
                    
                    <a href="{{ route('profile.edit') }}" 
                       class="flex items-center p-3 rounded-lg border border-gray-200 hover:bg-green-50 hover:border-green-300 transition">
                        <svg class="w-5 h-5 text-green-600 mr-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        <span class="font-medium text-gray-900">Edit Profile</span>
                    </a>
                    
                    <a href="{{ route('packages') }}" 
                       class="flex items-center p-3 rounded-lg border border-gray-200 hover:bg-purple-50 hover:border-purple-300 transition">
                        <svg class="w-5 h-5 text-purple-600 mr-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                        <span class="font-medium text-gray-900">Browse Tours</span>
                    </a>
                </div>
            </div>

            <!-- Write Review Section -->
            <div class="bg-white rounded-lg shadow">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h2 class="text-xl font-semibold text-gray-900">Write a Review</h2>
                </div>
                <div class="p-6">
                    @php
                        $completedTours = auth()->user()->bookings()
                            ->where('status', 'approved')
                            ->whereDoesntHave('reviews', function($query) {
                                $query->where('user_id', auth()->id());
                            })
                            ->with('tour')
                            ->get();
                    @endphp
                    
                    @if($completedTours->count() > 0)
                        <div class="space-y-4">
                            @foreach($completedTours as $booking)
                                <div class="border rounded-lg p-4">
                                    <div class="flex items-center justify-between mb-3">
                                        <div>
                                            <h4 class="font-medium text-gray-900">{{ $booking->tour->title }}</h4>
                                            <p class="text-sm text-gray-600">Completed on {{ $booking->booking_date->format('M d, Y') }}</p>
                                        </div>
                                        <button onclick="openReviewModal({{ $booking->tour->id }}, '{{ $booking->tour->title }}')" 
                                                class="bg-blue-600 text-white px-4 py-2 rounded-md text-sm hover:bg-blue-700 transition">
                                            Write Review
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-4">
                            <p class="text-sm text-gray-500">No tours available for review</p>
                            <p class="text-xs text-gray-400 mt-1">Complete a tour to write a review</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Recent Reviews -->
            <div class="bg-white rounded-lg shadow">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h2 class="text-xl font-semibold text-gray-900">Your Reviews</h2>
                </div>
                <div class="p-6">
                    @if(isset($recentReviews) && $recentReviews->count() > 0)
                        <div class="space-y-4">
                            @foreach($recentReviews as $review)
                                <div class="border rounded-lg p-4">
                                    <div class="flex items-center mb-2">
                                        <div class="flex text-yellow-400">
                                            @for($i = 1; $i <= 5; $i++)
                                                <svg class="w-4 h-4 {{ $i <= $review->rating ? 'text-yellow-400' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.538 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.783.57-1.838-.197-1.538-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                </svg>
                                            @endfor
                                        </div>
                                        <span class="ml-2 text-sm text-gray-600">{{ $review->tour->title }}</span>
                                    </div>
                                    <p class="text-sm text-gray-700">{{ Str::limit($review->comment, 100) }}</p>
                                    <p class="text-xs text-gray-500 mt-2">{{ $review->created_at->format('M d, Y') }}</p>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-4">
                            <p class="text-sm text-gray-500">No reviews yet</p>
                            <p class="text-xs text-gray-400 mt-1">Write reviews for your completed tours</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Notifications -->
            <div class="bg-white rounded-lg shadow">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h2 class="text-xl font-semibold text-gray-900">Notifications</h2>
                </div>
                <div class="p-6">
                    <div class="text-center py-4">
                        <svg class="mx-auto h-8 w-8 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-5 5v-5zM4 19h6v-6H4v6zM20 7h-6V1h6v6zM7 7h6V1H7v6z" />
                        </svg>
                        <p class="text-sm text-gray-500 mt-2">No new notifications</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Review Modal -->
<div id="reviewModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-medium text-gray-900" id="modalTitle">Write a Review</h3>
                <button onclick="closeReviewModal()" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            
            <form id="reviewForm" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Rating</label>
                    <div class="flex space-x-1">
                        <input type="radio" name="rating" value="1" id="star1" class="hidden">
                        <label for="star1" class="cursor-pointer text-2xl text-gray-300 hover:text-yellow-400" onclick="setRating(1)">★</label>
                        
                        <input type="radio" name="rating" value="2" id="star2" class="hidden">
                        <label for="star2" class="cursor-pointer text-2xl text-gray-300 hover:text-yellow-400" onclick="setRating(2)">★</label>
                        
                        <input type="radio" name="rating" value="3" id="star3" class="hidden">
                        <label for="star3" class="cursor-pointer text-2xl text-gray-300 hover:text-yellow-400" onclick="setRating(3)">★</label>
                        
                        <input type="radio" name="rating" value="4" id="star4" class="hidden">
                        <label for="star4" class="cursor-pointer text-2xl text-gray-300 hover:text-yellow-400" onclick="setRating(4)">★</label>
                        
                        <input type="radio" name="rating" value="5" id="star5" class="hidden">
                        <label for="star5" class="cursor-pointer text-2xl text-gray-300 hover:text-yellow-400" onclick="setRating(5)">★</label>
                    </div>
                </div>
                
                <div class="mb-4">
                    <label for="comment" class="block text-sm font-medium text-gray-700 mb-2">Your Review</label>
                    <textarea name="comment" id="comment" rows="4" required 
                              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                              placeholder="Share your experience..."></textarea>
                </div>
                
                <div class="flex justify-end space-x-3">
                    <button type="button" onclick="closeReviewModal()" 
                            class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-200 rounded-md hover:bg-gray-300">
                        Cancel
                    </button>
                    <button type="submit" 
                            class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700">
                        Submit Review
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
let currentTourId = null;

function openReviewModal(tourId, tourTitle) {
    currentTourId = tourId;
    document.getElementById('modalTitle').textContent = `Write a Review for ${tourTitle}`;
    document.getElementById('reviewForm').action = `/customer/reviews/${tourId}`;
    document.getElementById('reviewModal').classList.remove('hidden');
}

function closeReviewModal() {
    document.getElementById('reviewModal').classList.add('hidden');
    document.getElementById('reviewForm').reset();
    resetStars();
}

function setRating(rating) {
    resetStars();
    for (let i = 1; i <= rating; i++) {
        document.querySelector(`label[for="star${i}"]`).classList.remove('text-gray-300');
        document.querySelector(`label[for="star${i}"]`).classList.add('text-yellow-400');
        document.getElementById(`star${i}`).checked = true;
    }
}

function resetStars() {
    for (let i = 1; i <= 5; i++) {
        document.querySelector(`label[for="star${i}"]`).classList.remove('text-yellow-400');
        document.querySelector(`label[for="star${i}"]`).classList.add('text-gray-300');
        document.getElementById(`star${i}`).checked = false;
    }
}

// Close modal when clicking outside
document.getElementById('reviewModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeReviewModal();
    }
});
</script>
@endsection
