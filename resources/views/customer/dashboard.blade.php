@extends('layouts.customer')

@section('content')
<div class="container mx-auto">
    <h1 class="text-2xl mb-4">Welcome, {{ Auth::user()->name }}</h1>
    <p class="mb-4">Manage your bookings, profile and explore tours easily.</p>
    <div class="grid grid-cols-3 gap-4">
        <a href="{{ route('customer.bookings.index') }}" class="bg-blue-500 text-white p-4 rounded">My Bookings</a>
        <a href="{{ route('customer.profile.edit') }}" class="bg-green-500 text-white p-4 rounded">Edit Profile</a>
        <!-- <a href="{{ route('tours.index') }}" class="bg-purple-500 text-white p-4 rounded">Explore Tours</a> -->
    </div>
</div>
@endsection
