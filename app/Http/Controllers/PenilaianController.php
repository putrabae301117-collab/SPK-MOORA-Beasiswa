<?php

namespace App\Http\Controllers;

use App\Models\Alternatif;
use App\Models\Kriteria;
use App\Models\Penilaian;
use App\Models\Periode;
use App\Models\SubKriteria;
use Illuminate\Http\Request;

class PenilaianController extends Controller
{
    public function index(Periode $periode)
    {
        $alternatifs = Alternatif::where('id_periode', $periode->id)->get();

        $kriterias = Kriteria::with('subkriteria')->get();

        $penilaians = Penilaian::where('id_periode', $periode->id)
            ->with(['alternatif', 'kriteria', 'subkriteria'])
            ->paginate(100);

        $usedAlternatifs = $penilaians->pluck('id_alternatif')->toArray();

        $alternatifs = Alternatif::whereNotIn('id', $usedAlternatifs)->get();

        return view('penilaian.index', compact('periode', 'penilaians', 'alternatifs', 'kriterias'));
    }

    public function store(Request $request, Periode $periode)
    {
        $request->validate([
            'id_alternatif' => 'required|exists:alternatifs,id',
            'penilaian' => 'required|array',
            'penilaian.*' => 'required|exists:sub_kriterias,id',
        ]);

        foreach ($request->penilaian as $kriteriaId => $subKriteriaId) {
            $sub = SubKriteria::findOrFail($subKriteriaId);

            Penilaian::updateOrCreate(
                [
                    'id_periode' => $periode->id,
                    'id_alternatif' => $request->id_alternatif,
                    'id_kriteria' => $kriteriaId,
                ],
                [
                    'id_subkriteria' => $sub->id,
                    'nilai' => $sub->bobot_sub_kriteria,
                ]
            );
        }

        return redirect()->route('periode.penilaian.index', $periode->id)
            ->with('success', 'Penilaian berhasil disimpan');
    }

    public function edit(Periode $periode, Penilaian $penilaian)
    {
        $alternatifs = Alternatif::where('id_periode', $periode->id)->get();
        $kriterias = Kriteria::with('subkriteria')->get();

        return view('penilaian.edit', compact('periode', 'penilaian', 'alternatifs', 'kriterias'));
    }

    public function update(Request $request, Periode $periode, Penilaian $penilaian)
    {
        $request->validate([
            'id_subkriteria' => 'required|exists:sub_kriterias,id',
        ]);

        $sub = SubKriteria::findOrFail($request->id_subkriteria);

        $penilaian->update([
            'id_subkriteria' => $sub->id,
            'nilai' => $sub->bobot_sub_kriteria,
        ]);

        return redirect()->route('periode.penilaian.index', $periode->id)
            ->with('success', 'Penilaian berhasil diupdate');
    }

    public function destroy(Periode $periode, Penilaian $penilaian)
    {
        if (session('selected_penilaian_id') == $penilaian->id) {
            session()->forget(['selected_penilaian_id', 'selected_penilaian_nama']);
        }

        $penilaian->delete();

        return redirect()->route('periode.penilaian.index', $periode->id)
            ->with('success', 'Penilaian berhasil hapus');

    }
}
