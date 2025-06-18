@extends('layouts.admin')

@section('content')
<div class="container mx-auto">
    <h1 class="text-2xl mb-4">Add Destination</h1>
    <form action="{{ route('admin.destinations.store') }}" method="POST">
        @csrf
        <input type="text" name="name" placeholder="Name" class="border p-2 w-full mb-2" required>
        <textarea name="description" placeholder="Description" class="border p-2 w-full mb-2" required></textarea>
        <input type="text" name="location" placeholder="Location" class="border p-2 w-full mb-2" required>
        <input type="url" name="image_url" placeholder="Image URL" class="border p-2 w-full mb-2" required>
        <input type="text" name="category" placeholder="Category" class="border p-2 w-full mb-2" required>
        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Save</button>
    </form>
</div>
@endsection
