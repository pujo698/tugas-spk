<?php

namespace App\Http\Controllers;

use App\Models\Criterion;
use Illuminate\Http\Request;

class CriterionController extends Controller
{
    public function index(Request $request)
    {
        $query = Criterion::query();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('name', 'ilike', "%{$search}%")
                  ->orWhere('code', 'ilike', "%{$search}%");
        }

        $criteria = $query->orderBy('code')->get();
        return view('criteria.index', compact('criteria'));
    }

    public function create()
    {
        return view('criteria.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|unique:criteria',
            'name' => 'required',
            'type' => 'required|in:benefit,cost',
            'weight' => 'required|numeric',
        ]);
        Criterion::create($request->all());
        return redirect()->route('criteria.index')->with('success', 'Data Kriteria berhasil ditambahkan.');
    }

    public function edit(Criterion $criterion)
    {
        return view('criteria.edit', compact('criterion'));
    }

    public function update(Request $request, Criterion $criterion)
    {
        $request->validate([
            'code' => 'required|unique:criteria,code,' . $criterion->id,
            'name' => 'required',
            'type' => 'required|in:benefit,cost',
            'weight' => 'required|numeric',
        ]);
        $criterion->update($request->all());
        return redirect()->route('criteria.index')->with('success', 'Data Kriteria berhasil diperbarui.');
    }

    public function destroy(Criterion $criterion)
    {
        $criterion->delete();
        return redirect()->route('criteria.index')->with('success', 'Data Kriteria berhasil dihapus.');
    }
}
