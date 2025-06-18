@extends('layouts.admin')

@section('content')
<div class="container mx-auto">
    <h1 class="text-2xl mb-4">Edit Destination</h1>
    <form action="{{ route('admin.destinations.update', $destination) }}" method="POST">
        @csrf @method('PUT')
        <input type="text" name="name" value="{{ $destination->name }}" class="border p-2 w-full mb-2" required>
        <textarea name="description" class="border p-2 w-full mb-2" required>{{ $destination->description }}</textarea>
        <input type="text" name="location" value="{{ $destination->location }}" class="border p-2 w-full mb-2" required>
        <input type="url" name="image_url" value="{{ $destination->image_url }}" class="border p-2 w-full mb-2" required>
        <input type="text" name="category" value="{{ $destination->category }}" class="border p-2 w-full mb-2" required>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update</button>
    </form>
</div>
@endsection
