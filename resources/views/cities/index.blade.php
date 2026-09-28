@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Városok listája</h2>
    <a href="{{ route('cities.create') }}" class="btn btn-primary">Új város</a>
</div>

<form method="GET" action="{{ route('cities.index') }}" class="row g-2 mb-3">
    <div class="col-md-4">
        <input type="text" name="search" class="form-control" placeholder="Keresés név vagy irányítószám alapján..." value="{{ $search }}">
    </div>
    <div class="col-md-4">
        <select name="county_id" class="form-select">
            <option value="">-- Összes megye --</option>
            @foreach($counties as $county)
                <option value="{{ $county->id }}" {{ $countyId == $county->id ? 'selected' : '' }}>
                    {{ $county->name }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="col-md-2">
        <button type="submit" class="btn btn-secondary w-100">Szűrés / Keresés</button>
    </div>
</form>

<table class="table table-bordered bg-white shadow-sm">
    <thead>
        <tr>
            <th>Irányítószám</th>
            <th>Város</th>
            <th>Megye</th>
            <th>Lakosság</th>
            <th>Műveletek</th>
        </tr>
    </thead>
    <tbody>
        @forelse($cities as $city)
            <tr>
                <td>{{ $city->zip_code }}</td>
                <td>{{ $city->name }}</td>
                <td>{{ $city->county->name ?? '-' }}</td>
                <td>{{ number_format($city->population, 0, ',', ' ') }} fő</td>
                <td>
                    <a href="{{ route('cities.edit', $city) }}" class="btn btn-sm btn-warning">Szerkesztés</a>
                    <form action="{{ route('cities.destroy', $city) }}" method="POST" class="d-inline" onsubmit="return confirm('Biztosan törlöd?');">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger">Törlés</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5">Nincs találat.</td>
            </tr>
        @endforelse
    </tbody>
</table>

<div class="d-flex justify-content-center">
    {{ $cities->links('pagination::bootstrap-5') }}
</div>
@endsection