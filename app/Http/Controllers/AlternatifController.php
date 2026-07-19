<?php

namespace App\Http\Controllers;

use App\Models\Alternatif;
use App\Models\Periode;
use Illuminate\Http\Request;

class AlternatifController extends Controller
{
    public function index(Periode $periode)
    {
        $alternatifs = $periode->alternatifs()->paginate(10);

        return view('alternatif.index', compact('periode', 'alternatifs'));
    }

    public function store(Request $request, Periode $periode)
    {
        $validated = $request->validate([
            'nama_alternatif' => 'required|string|max:255',
        ]);

        $periode->alternatifs()->create($validated);

        return redirect()->route('periode.alternatif.index', $periode->id)
            ->with('success', 'Alternatif berhasil ditambahkan');
    }

    public function edit(Periode $periode, Alternatif $alternatif)
    {
        return view('alternatif.edit', compact('periode', 'alternatif'));
    }

    public function update(Request $request, Periode $periode, Alternatif $alternatif)
    {
        $validated = $request->validate([
            'nama_alternatif' => 'required|string|max:255',

        ]);

        $alternatif->update($validated);

        return redirect()->route('periode.alternatif.index', $periode->id)
            ->with('success', 'Alternatif berhasil diupdate');
    }

    public function destroy(Periode $periode, Alternatif $alternatif)
    {
        if (session('selected_alternatif_id') == $alternatif->id) {
            session()->forget(['selected_alternatif_id', 'selected_alternatif_nama']);
        }

        $alternatif->delete();

        return redirect()->route('periode.alternatif.index', $periode->id)
            ->with('success', 'Alternatif berhasil dihapus');
    }
}
