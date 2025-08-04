@extends('layouts.admin')

@section('title', 'Website Settings')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0">Website Settings</h1>
    <a href="{{ route('admin.settings.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> Add New Setting
    </a>
</div>

<div class="card">
    <div class="card-header">
        <ul class="nav nav-tabs card-header-tabs" id="settingsTabs" role="tablist">
            @foreach($groups as $groupKey => $groupLabel)
                <li class="nav-item" role="presentation">
                    <button class="nav-link {{ $loop->first ? 'active' : '' }}" 
                            id="{{ $groupKey }}-tab" 
                            data-bs-toggle="tab" 
                            data-bs-target="#{{ $groupKey }}" 
                            type="button" 
                            role="tab">
                        {{ $groupLabel }}
                    </button>
                </li>
            @endforeach
        </ul>
    </div>
    <div class="card-body">
        <div class="tab-content" id="settingsTabContent">
            @foreach($groups as $groupKey => $groupLabel)
                <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" 
                     id="{{ $groupKey }}" 
                     role="tabpanel">
                    
                    <form action="{{ route('admin.settings.update.bulk') }}" method="POST">
                        @csrf
                        
                        @if(isset($settings[$groupKey]) && $settings[$groupKey]->count() > 0)
                            <div class="row">
                                @foreach($settings[$groupKey] as $setting)
                                    <div class="col-md-6 mb-3">
                                        <div class="card">
                                            <div class="card-body">
                                                <label for="setting_{{ $setting->key }}" class="form-label">
                                                    <strong>{{ $setting->label }}</strong>
                                                    @if($setting->description)
                                                        <small class="text-muted d-block">{{ $setting->description }}</small>
                                                    @endif
                                                </label>
                                                
                                                @switch($setting->type)
                                                    @case('textarea')
                                                        <textarea 
                                                            name="settings[{{ $setting->key }}]" 
                                                            id="setting_{{ $setting->key }}"
                                                            class="form-control" 
                                                            rows="4">{{ old('settings.' . $setting->key, $setting->value) }}</textarea>
                                                        @break
                                                    
                                                    @case('boolean')
                                                        <select 
                                                            name="settings[{{ $setting->key }}]" 
                                                            id="setting_{{ $setting->key }}"
                                                            class="form-select">
                                                            <option value="1" {{ old('settings.' . $setting->key, $setting->value) == '1' ? 'selected' : '' }}>Yes</option>
                                                            <option value="0" {{ old('settings.' . $setting->key, $setting->value) == '0' ? 'selected' : '' }}>No</option>
                                                        </select>
                                                        @break
                                                    
                                                    @case('image')
                                                        <div class="input-group">
                                                            <input 
                                                                type="text" 
                                                                name="settings[{{ $setting->key }}]" 
                                                                id="setting_{{ $setting->key }}"
                                                                class="form-control" 
                                                                value="{{ old('settings.' . $setting->key, $setting->value) }}"
                                                                placeholder="Image URL">
                                                            <button class="btn btn-outline-secondary" type="button">
                                                                <i class="fas fa-upload"></i>
                                                            </button>
                                                        </div>
                                                        @if($setting->value)
                                                            <div class="mt-2">
                                                                <img src="{{ $setting->value }}" alt="Preview" class="img-thumbnail" style="max-height: 100px;">
                                                            </div>
                                                        @endif
                                                        @break
                                                    
                                                    @default
                                                        <input 
                                                            type="text" 
                                                            name="settings[{{ $setting->key }}]" 
                                                            id="setting_{{ $setting->key }}"
                                                            class="form-control" 
                                                            value="{{ old('settings.' . $setting->key, $setting->value) }}">
                                                @endswitch
                                                
                                                <div class="mt-2">
                                                    <a href="{{ route('admin.settings.edit', $setting) }}" class="btn btn-sm btn-outline-warning">
                                                        <i class="fas fa-edit"></i> Edit
                                                    </a>
                                                    <form action="{{ route('admin.settings.destroy', $setting) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-outline-danger" 
                                                                onclick="return confirm('Are you sure?')">
                                                            <i class="fas fa-trash"></i> Delete
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            
                            <div class="text-end">
                                <button type="submit" class="btn btn-success">
                                    <i class="fas fa-save"></i> Save {{ $groupLabel }}
                                </button>
                            </div>
                        @else
                            <div class="text-center py-4">
                                <i class="fas fa-cog fa-3x text-muted mb-3"></i>
                                <h5>No settings found for {{ $groupLabel }}</h5>
                                <p class="text-muted">Create your first setting for this group.</p>
                                <a href="{{ route('admin.settings.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus"></i> Add Setting
                                </a>
                            </div>
                        @endif
                    </form>
                </div>
            @endforeach
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="row mt-4">
    <div class="col-md-4">
        <div class="card bg-primary text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="mb-0">Content Management</h5>
                        <p class="mb-0">Update website content</p>
                    </div>
                    <div class="align-self-center">
                        <i class="fas fa-edit fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card bg-success text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="mb-0">SEO Settings</h5>
                        <p class="mb-0">Manage meta tags</p>
                    </div>
                    <div class="align-self-center">
                        <i class="fas fa-search fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card bg-info text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="mb-0">Social Media</h5>
                        <p class="mb-0">Update social links</p>
                    </div>
                    <div class="align-self-center">
                        <i class="fas fa-share-alt fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 