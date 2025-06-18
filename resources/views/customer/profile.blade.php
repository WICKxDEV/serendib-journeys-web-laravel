@extends('layouts.customer')

@section('content')
<div class="container mx-auto">
    <h1 class="text-2xl mb-4">Edit Profile</h1>
    <form action="{{ route('profile.update') }}" method="POST">
        @csrf @method('PATCH')
        <input type="text" name="name" value="{{ Auth::user()->name }}" class="border p-2 w-full mb-2" required>
        <input type="email" name="email" value="{{ Auth::user()->email }}" class="border p-2 w-full mb-2" required disabled>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update Profile</button>
    </form>
</div>
@endsection

@if(session('success'))
    <div class="bg-green-200 text-green-800 p-2 rounded mb-2">
        {{ session('success') }}
    </div>
@endif