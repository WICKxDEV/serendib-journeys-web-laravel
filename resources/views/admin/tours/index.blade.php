@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h3 mb-0">Tours</h1>
        <a href="{{ route('admin.tours.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add Tour
        </a>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover table-bordered align-middle">
                    <thead class="table-light">
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
                            <td>${{ number_format($tour->price, 2) }}</td>
                            <td>{{ $tour->available_from }}</td>
                            <td>{{ $tour->available_to }}</td>
                            <td>
                                <a href="{{ route('admin.tours.edit', $tour) }}" class="btn btn-sm btn-outline-warning me-1" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.tours.destroy', $tour) }}" method="POST" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete this tour?')" title="Delete">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
