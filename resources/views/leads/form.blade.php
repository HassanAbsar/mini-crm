@csrf
<div class="row">
    <div class="col-md-6">
        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $lead->name ?? '') }}" required>
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="{{ old('email', $lead->email ?? '') }}"
                required>
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-3">
            <label>Phone</label>
            <input type="text" name="phone" class="form-control" value="{{ old('phone', $lead->phone ?? '') }}"
                required>
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-3">
            <label>Status</label>
            <select name="status" class="form-control">
                <option value="new" {{ old('status', $lead->status ?? '') == 'new' ? 'selected' : '' }}>New</option>
                <option value="contacted" {{ old('status', $lead->status ?? '') == 'contacted' ? 'selected' : '' }}>
                    Contacted</option>
                <option value="closed" {{ old('status', $lead->status ?? '') == 'closed' ? 'selected' : '' }}>Closed
                </option>
            </select>
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-3">
            <label>Assign to Agent</label>
            <select name="assigned_to" class="form-control">
                <option value="0">Unassigned</option>
                @foreach ($agents as $agent)
                    <option value="{{ $agent->id }}"
                        {{ old('assigned_to', $lead->assigned_to ?? '') == $agent->id ? 'selected' : '' }}>
                        {{ $agent->name }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-3">
            <label>Notes</label>
            <textarea name="notes" class="form-control">{{ old('notes', $lead->notes ?? '') }}</textarea>
        </div>
    </div>
</div>











<div class="d-flex justify-content-end">
    <button class="btn btn-success">Save</button>
</div>
