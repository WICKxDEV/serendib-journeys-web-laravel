@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Edit Setting: {{ $setting->label }}</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.settings.update.setting', $setting->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="label">Label</label>
                            <input type="text" id="label" name="label" class="form-control" value="{{ old('label', $setting->label) }}">
                        </div>

                        <div class="form-group">
                            <label for="value">Value</label>
                            @if($setting->type === 'textarea')
                                <textarea id="value" name="value" class="form-control" rows="5">{{ old('value', $setting->value) }}</textarea>
                            @elseif($setting->type === 'boolean')
                                <select id="value" name="value" class="form-control">
                                    <option value="1" {{ old('value', $setting->value) == '1' ? 'selected' : '' }}>Yes</option>
                                    <option value="0" {{ old('value', $setting->value) == '0' ? 'selected' : '' }}>No</option>
                                </select>
                            @else
                                <input type="text" id="value" name="value" class="form-control" value="{{ old('value', $setting->value) }}">
                            @endif
                        </div>
                        
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea id="description" name="description" class="form-control" rows="3">{{ old('description', $setting->description) }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="group">Group</label>
                            <select id="group" name="group" class="form-control">
                                @foreach($groups as $key => $label)
                                    <option value="{{ $key }}" {{ old('group', $setting->group) === $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="type">Type</label>
                            <select id="type" name="type" class="form-control">
                                @foreach($types as $key => $label)
                                    <option value="{{ $key }}" {{ old('type', $setting->type) === $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <button type="submit" class="btn btn-primary">Update Setting</button>
                        <a href="{{ route('admin.settings.index') }}" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 