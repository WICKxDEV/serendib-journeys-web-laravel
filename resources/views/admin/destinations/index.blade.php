@extends('layouts.admin')

@section('content')
<div class="container mx-auto">
    <h1 class="text-2xl mb-4">Destinations</h1>
    <a href="{{ route('admin.destinations.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Add Destination</a>
    <table class="table-auto w-full mt-4">
        <thead>
            <tr>
                <th>Name</th>
                <th>Location</th>
                <th>Category</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($destinations as $destination)
            <tr>
                <td>{{ $destination->name }}</td>
                <td>{{ $destination->location }}</td>
                <td>{{ $destination->category }}</td>
                <td>
                    <a href="{{ route('admin.destinations.edit', $destination) }}" class="text-blue-500">Edit</a>
                    <form action="{{ route('admin.destinations.destroy', $destination) }}" method="POST" class="inline-block">
                        @csrf @method('DELETE')
                        <button type="submit" class="text-red-500" onclick="return confirm('Delete?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
