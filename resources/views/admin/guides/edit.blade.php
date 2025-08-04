@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Edit Guide</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.guides.index') }}">Tour Guides</a></li>
        <li class="breadcrumb-item active">Edit Guide</li>
    </ol>

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-user-edit me-1"></i>
            Edit Guide Information
        </div>
        <div class="card-body">
            <form action="{{ route('admin.guides.update', $guide) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name *</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                   id="name" name="name" value="{{ old('name', $guide->name) }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                   id="email" name="email" value="{{ old('email', $guide->email) }}">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="text" class="form-control @error('phone') is-invalid @enderror" 
                                   id="phone" name="phone" value="{{ old('phone', $guide->phone) }}">
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="location" class="form-label">Location</label>
                            <input type="text" class="form-control @error('location') is-invalid @enderror" 
                                   id="location" name="location" value="{{ old('location', $guide->location) }}">
                            @error('location')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="experience_years" class="form-label">Years of Experience</label>
                            <input type="number" class="form-control @error('experience_years') is-invalid @enderror" 
                                   id="experience_years" name="experience_years" 
                                   value="{{ old('experience_years', $guide->experience_years) }}" min="0">
                            @error('experience_years')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="languages" class="form-label">Languages</label>
                            <select class="form-select @error('languages') is-invalid @enderror" 
                                    id="languages" name="languages[]" multiple>
                                @php
                                    $selectedLanguages = old('languages', $guide->languages ?? []);
                                @endphp
                                <option value="English" {{ in_array('English', $selectedLanguages) ? 'selected' : '' }}>English</option>
                                <option value="Sinhala" {{ in_array('Sinhala', $selectedLanguages) ? 'selected' : '' }}>Sinhala</option>
                                <option value="Tamil" {{ in_array('Tamil', $selectedLanguages) ? 'selected' : '' }}>Tamil</option>
                                <option value="French" {{ in_array('French', $selectedLanguages) ? 'selected' : '' }}>French</option>
                                <option value="German" {{ in_array('German', $selectedLanguages) ? 'selected' : '' }}>German</option>
                                <option value="Spanish" {{ in_array('Spanish', $selectedLanguages) ? 'selected' : '' }}>Spanish</option>
                                <option value="Italian" {{ in_array('Italian', $selectedLanguages) ? 'selected' : '' }}>Italian</option>
                                <option value="Chinese" {{ in_array('Chinese', $selectedLanguages) ? 'selected' : '' }}>Chinese</option>
                                <option value="Japanese" {{ in_array('Japanese', $selectedLanguages) ? 'selected' : '' }}>Japanese</option>
                            </select>
                            @error('languages')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="profile_photo" class="form-label">Profile Photo</label>
                            @if($guide->profile_photo)
                                <div class="mb-2">
                                    <img src="{{ $guide->profile_photo_url }}" alt="Current photo" 
                                         class="img-thumbnail" style="max-width: 150px;">
                                </div>
                            @endif
                            <input type="file" class="form-control @error('profile_photo') is-invalid @enderror" 
                                   id="profile_photo" name="profile_photo" accept="image/*">
                            @error('profile_photo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="bio" class="form-label">Bio *</label>
                    <textarea class="form-control @error('bio') is-invalid @enderror" 
                              id="bio" name="bio" rows="4" required>{{ old('bio', $guide->bio) }}</textarea>
                    @error('bio')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="specializations" class="form-label">Specializations</label>
                    <textarea class="form-control @error('specializations') is-invalid @enderror" 
                              id="specializations" name="specializations" rows="3">{{ old('specializations', $guide->specializations) }}</textarea>
                    @error('specializations')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('admin.guides.index') }}" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-primary">Update Guide</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection 