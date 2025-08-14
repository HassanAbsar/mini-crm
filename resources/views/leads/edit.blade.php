@extends('layouts.app')
@section('content')
<h2>Edit Lead</h2>
<div class="d-flex justify-content-end">
<a href="{{ route('leads.index') }}" class="btn btn-secondary">Back</a>
</div>
<form action="{{ route('leads.update', $lead->id) }}" method="POST">
    @method('PUT')
    @include('leads.form')
</form>
@endsection
