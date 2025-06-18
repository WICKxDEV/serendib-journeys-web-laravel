@extends('layouts.admin')

@section('content')
<div class="container mx-auto">
    <h1 class="text-2xl mb-4">Add Tour</h1>
    <form action="{{ route('admin.tours.store') }}" method="POST">
        @csrf
        <select name="destination_id" class="border p-2 w-full mb-2" required>
            <option value="">Select Destination</option>
            @foreach($destinations as $destination)
                <option value="{{ $destination->id }}">{{ $destination->name }}</option>
            @endforeach
        </select>
        <input type="text" name="title" placeholder="Tour Title" class="border p-2 w-full mb-2" required>
        <textarea name="description" placeholder="Description" class="border p-2 w-full mb-2" required></textarea>
        <input type="number" step="0.01" name="price" placeholder="Price" class="border p-2 w-full mb-2" required>
        <textarea name="itinerary" placeholder="Itinerary" class="border p-2 w-full mb-2" required></textarea>
        <input type="date" name="available_from" class="border p-2 w-full mb-2" required>
        <input type="date" name="available_to" class="border p-2 w-full mb-2" required>
        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Save</button>
    </form>
</div>
@endsection
