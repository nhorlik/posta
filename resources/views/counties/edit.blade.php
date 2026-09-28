@extends('layouts.app')

@section('content')
<h2>Megye szerkesztése</h2>
<form action="{{ route('counties.update', $county) }}" method="POST" enctype="multipart/form-data" class="bg-white p-4 rounded shadow-sm">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label for="name" class="form-label">Megye neve</label>
        <input type="text" name="name" id="name" class="form-control" value="{{ $county->name }}" required>
    </div>
    <div class="mb-3">
        <label for="badge" class="form-label">Címer kép módosítása</label>
        <input type="file" name="badge" id="badge" class="form-control">
        @if($county->badge)
            <div class="mt-2">
                <img src="{{ asset('storage/' . $county->badge) }}" height="50">
            </div>
        @endif
    </div>
    <button type="submit" class="btn btn-success">Módosítások mentése</button>
    <a href="{{ route('counties.index') }}" class="btn btn-secondary">Mégse</a>
</form>
@endsection