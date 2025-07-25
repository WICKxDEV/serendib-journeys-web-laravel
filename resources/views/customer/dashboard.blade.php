@extends('layouts.customer')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-lg shadow p-6 mb-6 flex items-center">
        <div class="flex-shrink-0 bg-blue-100 rounded-full p-3 mr-4">
            <svg class="w-8 h-8 text-blue-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5.121 17.804A13.937 13.937 0 0112 15c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
        </div>
        <div>
            <h1 class="text-2xl font-bold mb-1">Welcome, {{ Auth::user()->name }}</h1>
            <p class="text-gray-600">Manage your bookings, profile, and explore tours easily.</p>
        </div>
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
        <a href="{{ route('customer.bookings.index') }}" class="bg-white rounded-lg shadow p-6 flex flex-col items-center hover:bg-blue-50 transition">
            <svg class="w-10 h-10 text-blue-500 mb-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
            <span class="font-semibold text-lg text-blue-700">My Bookings</span>
        </a>
        <a href="{{ route('profile.edit') }}" class="bg-white rounded-lg shadow p-6 flex flex-col items-center hover:bg-green-50 transition">
            <svg class="w-10 h-10 text-green-500 mb-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536M9 11l6 6M3 21h6a2 2 0 002-2v-6a2 2 0 00-2-2H3a2 2 0 00-2 2v6a2 2 0 002 2z" /></svg>
            <span class="font-semibold text-lg text-green-700">Edit Profile</span>
        </a>
        <a href="{{ route('booking.form') }}" class="bg-white rounded-lg shadow p-6 flex flex-col items-center hover:bg-purple-50 transition">
            <svg class="w-10 h-10 text-purple-500 mb-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 7v4a1 1 0 001 1h3m10-5v4a1 1 0 01-1 1h-3m-4 4h4m-2 0v4m0 0H7a2 2 0 01-2-2v-2a2 2 0 012-2h10a2 2 0 012 2v2a2 2 0 01-2 2h-4z" /></svg>
            <span class="font-semibold text-lg text-purple-700">Explore Tours</span>
        </a>
    </div>
</div>
@endsection
