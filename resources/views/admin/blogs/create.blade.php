@extends('layouts.admin')

@section('title', 'Create Blog Post')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Create New Blog Post</h1>
    <p class="mb-4">Fill out the form below to create a new blog post.</p>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('admin.blogs.store') }}" method="POST" enctype="multipart/form-data">
                @include('admin.blogs._form', ['buttonText' => 'Create Post'])
            </form>
        </div>
    </div>
</div>
@endsection 