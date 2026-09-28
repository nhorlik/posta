@extends('layouts.app')

@section('content')
<h2>Új város hozzáadása</h2>
<form action="{{ route('cities.store') }}" method="POST" class="bg-white p-4 rounded shadow-sm">
    @csrf
    <div class="mb-3">
        <label for="county_id" class="form-label">Megye</label>
        <select name="county_id" id="county_id" class="form-select" required>
            <option value="">Válasszon megyét...</option>
            @foreach($counties as $county)
                <option value="{{ $county->id }}">{{ $county->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label for="name" class="form-label">Város neve</label>
        <input type="text" name="name" id="name" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="zip_code" class="form-label">Irányítószám</label>
        <input type="text" name="zip_code" id="zip_code" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="population" class="form-label">Lakosság</label>
        <input type="number" name="population" id="population" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-success">Mentés</button>
    <a href="{{ route('cities.index') }}" class="btn btn-secondary">Mégse</a>
</form>
@endsection