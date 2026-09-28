<?php

namespace App\Http\Controllers;

use App\Models\County;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CountyController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $counties = County::withSum('cities', 'population')
            ->when($search, function ($query, $search) {
                return $query->where('name', 'like', "%{$search}%");
            })
            ->get();

        return view('counties.index', compact('counties', 'search'));
    }

    public function create()
    {
        return view('counties.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'badge' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('badge')) {
            $file = $request->file('badge');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('megyekep'), $filename);
            $validated['badge'] = $filename;
        }

        County::create($validated);

        return redirect()->route('counties.index')->with('success', 'Megye sikeresen létrehozva.');
    }

    public function edit(County $county)
    {
        return view('counties.edit', compact('county'));
    }

    public function update(Request $request, County $county)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'badge' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('badge')) {
            // Régi kép törlése, ha létezik
            if ($county->badge && file_exists(public_path('megyekep/' . $county->badge))) {
                unlink(public_path('megyekep/' . $county->badge));
            }

            $file = $request->file('badge');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('megyekep'), $filename);
            $validated['badge'] = $filename;
        }

        $county->update($validated);

        return redirect()->route('counties.index')->with('success', 'Megye sikeresen frissítve.');
    }

    public function destroy(County $county)
    {
        if ($county->badge && Storage::disk('public')->exists($county->badge)) {
            Storage::disk('public')->delete($county->badge);
        }
        $county->delete();

        return redirect()->route('counties.index')->with('success', 'Megye törölve.');
    }
}