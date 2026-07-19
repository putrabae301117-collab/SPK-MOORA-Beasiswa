<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use Illuminate\Http\Request;

class KriteriaController extends Controller
{
    public function index()
    {
        $kriterias = Kriteria::all();

        return view('kriteria.index', compact('kriterias'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_kriteria' => 'required|string|max:255',
            'bobot' => 'required',
            'jenis' => 'required|string',
        ]);

        Kriteria::create($validated);

        return redirect()->route('kriteria.index')
            ->with('success', 'Kriteria berhasil ditambahkan');
    }

    public function edit(Kriteria $kriteria)
    {
        return view('kriteria.edit', compact('kriteria'));
    }

    public function update(Request $request, Kriteria $kriteria)
    {
        $validated = $request->validate([
            'nama_kriteria' => 'required|string|max:255',
            'bobot' => 'required',
            'jenis' => 'required|string',
        ]);

        $kriteria->update($validated);

        return redirect()->route('kriteria.index')
            ->with('success', 'Kriteria berhasil diupdate');
    }

    public function destroy(Kriteria $kriteria)
    {
        if ($kriteria->subkriteria()->count() > 0) {
            return redirect()->route('kriteria.index')
                ->with('error', 'Kriteria tidak dapat dihapus karena masih digunakan pada Sub Kriteria.');
        }

        if (session('selected_kriteria_id') == $kriteria->id) {
            session()->forget(['selected_kriteria_id', 'selected_kriteria_nama']);
        }

        $kriteria->delete();

        return redirect()->route('kriteria.index')->with('success', 'Kriteria berhasil dihapus');

    }
}
