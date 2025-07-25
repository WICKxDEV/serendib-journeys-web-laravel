@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Tour Guides</h1>
    <a href="{{ route('admin.guides.create') }}" class="btn btn-primary mb-3">Add New Guide</a>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Created At</th>
            </tr>
        </thead>
        <tbody>
            @foreach($guides as $guide)
                <tr>
                    <td>{{ $guide->name }}</td>
                    <td>{{ $guide->email }}</td>
                    <td>{{ $guide->created_at->format('Y-m-d') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection 