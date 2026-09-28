@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Megyék listája</h2>
    <a href="{{ route('counties.create') }}" class="btn btn-primary">Új megye</a>
</div>

<form method="GET" action="{{ route('counties.index') }}" class="row g-2 mb-3">
    <div class="col-auto">
        <input type="text" name="search" class="form-control" placeholder="Keresés név alapján..." value="{{ $search }}">
    </div>
    <div class="col-auto">
        <button type="submit" class="btn btn-secondary">Keresés</button>
    </div>
</form>

<table class="table table-bordered bg-white shadow-sm align-middle">
    <thead>
        <tr>
            <th>Címer</th>
            <th>Név</th>
            <th>Összlakosság</th>
            <th>Műveletek</th>
        </tr>
    </thead>
    <tbody>
        @forelse($counties as $county)
            <tr>
                <td style="width: 80px; text-align: center;">
                    @if($county->badge)
                        <img src="{{ asset('megyekep/' . $county->badge) }}" alt="{{ $county->name }}" style="max-height: 50px;">
                    @else
                        <span class="text-muted">Nincs</span>
                    @endif
                </td>
                <td>{{ $county->name }}</td>
                <td>{{ number_format($county->cities_sum_population ?? 0, 0, ',', ' ') }} fő</td>
                <td>
                    <a href="{{ route('counties.edit', $county) }}" class="btn btn-sm btn-warning">Szerkesztés</a>
                    <form action="{{ route('counties.destroy', $county) }}" method="POST" class="d-inline" onsubmit="return confirm('Biztosan törlöd?');">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger">Törlés</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="4">Nincs találat.</td>
            </tr>
        @endforelse
    </tbody>
</table>
@endsection