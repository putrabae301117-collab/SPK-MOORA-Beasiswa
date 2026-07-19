<?php

namespace App\Http\Controllers;

use App\Models\Alternatif;
use App\Models\Penilaian;
use App\Models\Periode;
use Illuminate\Http\Request;

class PeriodeController extends Controller
{
    public function index()
    {
        $periodes = Periode::withCount(['alternatifs','penilaians'])->latest()->paginate(10);
        return view('periode.index', compact('periodes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_periode' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'keterangan' => 'required|string',
        ]);

        Periode::create($validated);

        return redirect()->route('periode.index')
            ->with('success', 'Periode berhasil ditambahkan');
    }

    public function show(Periode $periode)
    {
        $periodes = Periode::all();
        session([
            'selected_periode_id' => $periode->id,
            'selected_periode_nama' => $periode->nama_periode,
        ]);

        return view('periode.show', compact('periode'));
    }

    public function edit(Periode $periode)
    {
        return view('periode.edit', compact('periode'));
    }

    public function update(Request $request, Periode $periode)
    {
        $validated = $request->validate([
            'nama_periode' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'keterangan' => 'required|string',
        ]);

        $periode->update($validated);

        return redirect()->route('periode.index')
            ->with('success', 'Periode berhasil diupdate');
    }

    public function destroy(Periode $periode)
    {
        if (session('selected_periode_id') == $periode->id) {
            session()->forget(['selected_periode_id', 'selected_periode_nama']);
        }

        $periode->delete();

        return redirect()->route('periode.index')
            ->with('success', 'Periode berhasil dihapus');
    }

    public function selectPeriode(Periode $periode)
    {
        session([
            'selected_periode_id' => $periode->id,
            'selected_periode_nama' => $periode->nama_periode,
        ]);

        return redirect()->route('periode.show', $periode)
            ->with('success', 'Periode '.$periode->nama_periode.' telah dipilih');
    }

    public function clearPeriode()
    {
        session()->forget(['selected_periode_id', 'selected_periode_nama']);

        return redirect()->route('periode.index')
            ->with('success', 'Periode telah ditutup');
    }
}
