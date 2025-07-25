@extends('layouts.admin')

@section('title', 'Edit Blog Post')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Edit Blog Post</h1>
    <p class="mb-4">Update the form below to edit the blog post.</p>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('admin.blogs.update', $blog) }}" method="POST" enctype="multipart/form-data">
                @method('PUT')
                @include('admin.blogs._form', ['blog' => $blog, 'buttonText' => 'Update Post'])
            </form>
        </div>
    </div>
</div>
@endsection
