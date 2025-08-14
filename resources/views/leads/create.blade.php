@extends('layouts.app')
@section('content')
<h2>Create Lead</h2>
<div class="d-flex justify-content-end">
<a href="{{ route('leads.index') }}" class="btn btn-secondary">Back</a>
</div>
<form action="{{ route('leads.store') }}" method="POST">
    @include('leads.form')
</form>
@endsection
