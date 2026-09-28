<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\County;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $countyId = $request->input('county_id');

        $cities = City::with('county')
            ->when($search, function ($query, $search) {
                return $query->where('name', 'like', "%{$search}%")
                             ->orWhere('zip_code', 'like', "%{$search}%");
            })
            ->when($countyId, function ($query, $countyId) {
                return $query->where('county_id', $countyId);
            })
            ->paginate(15)
            ->withQueryString();

        $counties = County::orderBy('name')->get();

        return view('cities.index', compact('cities', 'counties', 'search', 'countyId'));
    }

    public function create()
    {
        $counties = County::orderBy('name')->get();
        return view('cities.create', compact('counties'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'county_id' => 'required|exists:counties,id',
            'name' => 'required|string|max:255',
            'zip_code' => 'required|string|max:10',
            'population' => 'required|integer|min:0',
        ]);

        City::create($validated);

        return redirect()->route('cities.index')->with('success', 'Város sikeresen létrehozva.');
    }

    public function edit(City $city)
    {
        $counties = County::orderBy('name')->get();
        return view('cities.edit', compact('city', 'counties'));
    }

    public function update(Request $request, City $city)
    {
        $validated = $request->validate([
            'county_id' => 'required|exists:counties,id',
            'name' => 'required|string|max:255',
            'zip_code' => 'required|string|max:10',
            'population' => 'required|integer|min:0',
        ]);

        $city->update($validated);

        return redirect()->route('cities.index')->with('success', 'Város sikeresen frissítve.');
    }

    public function destroy(City $city)
    {
        $city->delete();

        return redirect()->route('cities.index')->with('success', 'Város törölve.');
    }
}