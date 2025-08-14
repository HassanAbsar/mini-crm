@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="mb-0">Leads</h2>
    <a href="{{ route('leads.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> Add Lead
    </a>
</div>

<div class="row mb-3">
    <div class="col-md-3">
        <select id="filter-status" class="form-control">
            <option value="">-- Filter by Status --</option>
            <option value="new">New</option>
            <option value="contacted">Contacted</option>
            <option value="closed">Closed</option>
        </select>
    </div>
    <div class="col-md-3">
        <select id="filter-agent" class="form-control">
            <option value="">-- Filter by Agent --</option>
            @foreach($agents as $agent)
                <option value="{{ $agent->id }}">{{ $agent->name }}</option>
            @endforeach
        </select>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <table class="table table-bordered" id="leads-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Status</th>
                    <th>Assigned To</th>
                    <th>Notes</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>


@push('custom_scripts')

<script>
$(document).ready(function() {
    let table = $('#leads-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "{{ route('leads.data') }}",
            data: function (d) {
                d.status = $('#filter-status').val();
                d.agent = $('#filter-agent').val();
            }
        },
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
            { data: 'name', name: 'name' },
            { data: 'email', name: 'email' },
            { data: 'phone', name: 'phone' },
            { data: 'status', name: 'status' },
            { data: 'agent_name', name: 'agent_name' },
            { data: 'notes', name: 'notes' },
            { data: 'actions', name: 'actions', orderable: false, searchable: false }
        ]
    });

    // Apply filters
    $('#filter-status, #filter-agent').change(function() {
        table.ajax.reload();
    });
});
</script>
@endpush
@endsection
