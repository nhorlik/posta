@extends('layouts.app')

@section('content')
<h2>Város szerkesztése</h2>
<form action="{{ route('cities.update', $city) }}" method="POST" class="bg-white p-4 rounded shadow-sm">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label for="county_id" class="form-label">Megye</label>
        <select name="county_id" id="county_id" class="form-select" required>
            @foreach($counties as $county)
                <option value="{{ $county->id }}" {{ $city->county_id == $county->id ? 'selected' : '' }}>
                    {{ $county->name }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label for="name" class="form-label">Város neve</label>
        <input type="text" name="name" id="name" class="form-control" value="{{ $city->name }}" required>
    </div>
    <div class="mb-3">
        <label for="zip_code" class="form-label">Irányítószám</label>
        <input type="text" name="zip_code" id="zip_code" class="form-control" value="{{ $city->zip_code }}" required>
    </div>
    <div class="mb-3">
        <label for="population" class="form-label">Lakosság</label>
        <input type="number" name="population" id="population" class="form-control" value="{{ $city->population }}" required>
    </div>
    <button type="submit" class="btn btn-success">Módosítások mentése</button>
    <a href="{{ route('cities.index') }}" class="btn btn-secondary">Mégse</a>
</form>
@endsection