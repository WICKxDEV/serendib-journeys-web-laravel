@extends('layouts.admin')

@section('content')
<div class="container mx-auto">
    <h1 class="text-2xl mb-4">Edit Tour</h1>
    <form action="{{ route('admin.tours.update', $tour) }}" method="POST">
        @csrf @method('PUT')
        <select name="destination_id" class="border p-2 w-full mb-2" required>
            @foreach($destinations as $destination)
                <option value="{{ $destination->id }}" {{ $tour->destination_id == $destination->id ? 'selected' : '' }}>
                    {{ $destination->name }}
                </option>
            @endforeach
        </select>
        <input type="text" name="title" value="{{ $tour->title }}" class="border p-2 w-full mb-2" required>
        <textarea name="description" class="border p-2 w-full mb-2" required>{{ $tour->description }}</textarea>
        <input type="number" step="0.01" name="price" value="{{ $tour->price }}" class="border p-2 w-full mb-2" required>
        <textarea name="itinerary" class="border p-2 w-full mb-2" required>{{ $tour->itinerary }}</textarea>
        <input type="date" name="available_from" value="{{ $tour->available_from }}" class="border p-2 w-full mb-2" required>
        <input type="date" name="available_to" value="{{ $tour->available_to }}" class="border p-2 w-full mb-2" required>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update</button>
    </form>
</div>
@endsection
