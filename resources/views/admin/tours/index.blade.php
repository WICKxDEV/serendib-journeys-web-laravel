@extends('layouts.admin')

@section('content')
<div class="container mx-auto">
    <h1 class="text-2xl mb-4">Tours</h1>
    <a href="{{ route('admin.tours.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Add Tour</a>
    <table class="table-auto w-full mt-4">
        <thead>
            <tr>
                <th>Title</th>
                <th>Destination</th>
                <th>Price</th>
                <th>Available From</th>
                <th>Available To</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tours as $tour)
            <tr>
                <td>{{ $tour->title }}</td>
                <td>{{ $tour->destination->name }}</td>
                <td>${{ $tour->price }}</td>
                <td>{{ $tour->available_from }}</td>
                <td>{{ $tour->available_to }}</td>
                <td>
                    <a href="{{ route('admin.tours.edit', $tour) }}" class="text-blue-500">Edit</a>
                    <form action="{{ route('admin.tours.destroy', $tour) }}" method="POST" class="inline-block">
                        @csrf @method('DELETE')
                        <button type="submit" class="text-red-500" onclick="return confirm('Delete this tour?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
