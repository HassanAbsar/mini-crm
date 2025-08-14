@extends('layouts.app')

@section('content')
<h2>View Lead</h2>
<div class="d-flex justify-content-end">
<a href="{{ route('leads.index') }}" class="btn btn-secondary">Back</a>
</div>

            <div class="row">

                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="fw-bold">Name</label>
                        <p class="form-control border">{{ $lead->name }}</p>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="fw-bold">Email</label>
                        <p class="form-control border">{{ $lead->email }}</p>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="fw-bold">Phone</label>
                        <p class="form-control border">{{ $lead->phone }}</p>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="fw-bold">Status</label>
                        <p class="form-control border">
                            {{ ucfirst($lead->status) }}
                        </p>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="fw-bold">Assigned To</label>
                        <p class="form-control border">
                            {{ $lead->assigned_to ? $lead->agent->name : 'Unassigned' }}
                        </p>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="fw-bold">Notes</label>
                        <p class="form-control border" style="min-height: 80px;">
                            {{ $lead->notes ?? 'No notes available.' }}
                        </p>
                    </div>
                </div>

            </div>


@endsection
