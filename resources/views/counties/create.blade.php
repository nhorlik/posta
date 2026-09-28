@extends('layouts.app')

@section('content')
<h2>Új megye hozzáadása</h2>
<form action="{{ route('counties.store') }}" method="POST" enctype="multipart/form-data" class="bg-white p-4 rounded shadow-sm">
    @csrf
    <div class="mb-3">
        <label for="name" class="form-label">Megye neve</label>
        <input type="text" name="name" id="name" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="badge" class="form-label">Címer kép</label>
        <input type="file" name="badge" id="badge" class="form-control">
    </div>
    <button type="submit" class="btn btn-success">Mentés</button>
    <a href="{{ route('counties.index') }}" class="btn btn-secondary">Mégse</a>
</form>
@endsection