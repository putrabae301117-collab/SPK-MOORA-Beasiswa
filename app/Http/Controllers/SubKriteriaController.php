<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use App\Models\SubKriteria;
use Illuminate\Http\Request;

class SubKriteriaController extends Controller
{
    public function index()
    {
        $kriterias = Kriteria::orderBy('nama_kriteria')->get();

        $subkriterias = SubKriteria::with('kriteria')->paginate(10);

        return view('subkriteria.index', compact('kriterias', 'subkriterias'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_kriteria' => 'required|exists:kriterias,id',
            'nama_sub_kriteria' => 'required|string|max:255',
            'bobot_sub_kriteria' => 'required|numeric',
            'keterangan' => 'nullable|string',
        ]);

        SubKriteria::create($validated);

        return redirect()->route('subkriteria.index')
            ->with('success', 'Sub Kriteria berhasil ditambahkan');
    }

    public function edit(SubKriteria $subkriteria)
    {
        $kriterias = Kriteria::orderBy('nama_kriteria')->get();

        return view('subkriteria.edit', compact('subkriteria', 'kriterias'));
    }

    public function update(Request $request, SubKriteria $subkriteria)
    {
        $validated = $request->validate([
            'id_kriteria' => 'required|exists:kriterias,id',
            'nama_sub_kriteria' => 'required|string|max:255',
            'bobot_sub_kriteria' => 'required|numeric',
            'keterangan' => 'nullable|string',
        ]);

        $subkriteria->update($validated);

        return redirect()->route('subkriteria.index')
            ->with('success', 'Sub Kriteria berhasil diupdate');
    }

    public function destroy(SubKriteria $subkriteria)
    {
        if (session('selected_sub_kriteria_id') == $subkriteria->id) {
            session()->forget([
                'selected_sub_kriteria_id',
                'selected_sub_kriteria_nama',
            ]);
        }

        $subkriteria->delete();

        return redirect()
            ->route('subkriteria.index')
            ->with('success', 'Sub Kriteria berhasil dihapus');
    }
}
