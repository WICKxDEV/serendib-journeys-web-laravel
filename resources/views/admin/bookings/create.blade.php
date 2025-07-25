<div class="mb-3">
    <label for="guide_id" class="form-label">Assign Guide</label>
    <select name="guide_id" id="guide_id" class="form-control">
        <option value="">-- Unassigned --</option>
        @foreach($guides as $guide)
            <option value="{{ $guide->id }}">{{ $guide->name }} ({{ $guide->email }})</option>
        @endforeach
    </select>
</div> 