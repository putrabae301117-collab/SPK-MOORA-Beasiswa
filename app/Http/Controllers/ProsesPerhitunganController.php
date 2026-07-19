<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use App\Models\Penilaian;
use App\Models\Periode;
use App\Models\ProsesPerhitungan;
use Illuminate\Http\Request;

class ProsesPerhitunganController extends Controller
{
    public function index(Periode $periode)
    {
        $kriterias = Kriteria::with('subkriteria')->get();

        $penilaians = Penilaian::where('id_periode', $periode->id)
            ->with(['alternatif', 'kriteria', 'subkriteria'])
            ->get();
        
        $alternatifs = $penilaians->pluck('alternatif')->unique('id')->values();

        $matrix = [];

        foreach ($penilaians as $p) {
            $matrix[$p->id_alternatif][$p->id_kriteria] = $p->nilai;
        }
         return view('perhitungan.index', compact(
            'periode',
            'alternatifs',
            'kriterias',           
            'penilaians',
            'matrix'
        ));
    }

    public function hitung(Periode $periode)
    {
        $penilaians = Penilaian::where('id_periode',$periode->id)->get();
        $kriterias = Kriteria::with('subkriteria')->get();

        // Validasi
        if ($penilaians->isEmpty() || $kriterias->isEmpty()) {
            return redirect()->back()->with('error', 'Data penilaian atau kriteria tidak ditemukan');
        }
        
        // Rumus Matrix
        $matrix = [];
        foreach($penilaians as $p) {
            $matrix[$p->id_alternatif][$p->id_kriteria] = $p->nilai;
        }

        // Rumus Normalisasi
        $normalisasi = [];
        foreach($kriterias as $k) {

            $sumKuadrat = 0;
            foreach($matrix as $altId => $nilaiAlt){
                $nilaiKriteria = $nilaiAlt[$k->id]??0;
                $sumKuadrat += pow($nilaiKriteria,2);
            }

            $pembagi = sqrt($sumKuadrat);

            foreach($matrix as $altId => $nilaiAlt) {
                $nilaiKriteria = $nilaiAlt[$k->id] ?? 0;

                if($pembagi == 0){
                    $normalisasi[$altId][$k->id] = 0;
                }else {
                    $normalisasi[$altId][$k->id]=$nilaiKriteria/ $pembagi;
                }
            }
        }

        // Rumus Normalisasi Terbobot
        $terbobot = [];
        foreach($normalisasi as $altId => $nilaiNorm){
            foreach($kriterias as $k) {
                $bobotFix = $k->bobot >1 ? $k->bobot / 100 : $k->bobot;

                $terbobot[$altId][$k->id] = ($nilaiNorm[$k->id] ?? 0) * $bobotFix;
            }
        }

        // Rumus Hitung Yi
        $hasil = [];
        foreach($terbobot as $altId => $nilaiTerbobot) {
            $benefit = 0;
            $cost = 0;

            foreach($kriterias as $k) {
                $nilai = $nilaiTerbobot[$k->id] ?? 0;
                
                if (strtolower($k->jenis) == 'benefit') {
                $benefit += $nilai;
            } else {
                $cost += $nilai;
            }
        }

        $hasil[$altId] = $benefit - $cost;
    }

    // Rangking
    arsort($hasil); // diurutkan nilai yang paling besar

    ProsesPerhitungan::where('id_periode',$periode->id)->delete();

    $rank = 1;
    foreach ($hasil as $altId => $yi) {
        ProsesPerhitungan::create([
            'id_periode'     => $periode->id,
            'id_alternatif'  => $altId,
            'nilai_yi'       => $yi,
            'peringkat'      => $rank++
        ]);
    }
        return redirect()->route('periode.perhitungan.hasil', $periode->id)
            ->with('success', 'Proses perhitungan berhasil disimpan');
    }

    public function debug(Periode $periode)
    {
        $penilaians = Penilaian::where('id_periode', $periode->id)->get();
        $kriterias = Kriteria::with('subkriteria')->get();
        
        // Matrix
        $matrix = [];
        foreach($penilaians as $p) {
            $matrix[$p->id_alternatif][$p->id_kriteria] = $p->nilai;
        }

        // Normalisasi
        $normalisasi = [];
        foreach($kriterias as $k) {
            $sumKuadrat = 0;
            foreach ($matrix as $altId => $nilaiAlt) {
                $sumKuadrat += pow($nilaiAlt[$k->id] ?? 0, 2);
            }
            $pembagi = sqrt($sumKuadrat);
            
            foreach ($matrix as $altId => $nilaiAlt) {
                $nilaiKriteria = $nilaiAlt[$k->id] ?? 0;
                $normalisasi[$altId][$k->id] = $pembagi == 0 ? 0 : $nilaiKriteria / $pembagi;
            }
        }

        // Terbobot
        $terbobot = [];
        foreach($normalisasi as $altId => $nilaiNorm) {
            foreach($kriterias as $k) {
                $bobotFix = $k->bobot > 1 ? $k->bobot / 100 : $k->bobot;
                $terbobot[$altId][$k->id] = ($nilaiNorm[$k->id] ?? 0) * $bobotFix;
            }
        }

        // Yi
        $hasil = [];
        foreach($terbobot as $altId => $nilaiTerbobot) {
            $benefit = 0;
            $cost = 0;
            foreach($kriterias as $k) {
                if (strtolower($k->jenis) == 'benefit') {
                    $benefit += $nilaiTerbobot[$k->id] ?? 0;
                } else {
                    $cost += $nilaiTerbobot[$k->id] ?? 0;
                }
            }
            $hasil[$altId] = $benefit - $cost;
        }

        // Return untuk debugging
        return response()->json([
            'kriterias' => $kriterias->map(function($k) {
                return [
                    'id' => $k->id,
                    'nama' => $k->nama_kriteria,
                    'bobot_asli' => $k->bobot,
                    'bobot_fix' => $k->bobot > 1 ? $k->bobot / 100 : $k->bobot,
                    'jenis' => $k->jenis
                ];
            }),
            'matrix' => $matrix,
            'normalisasi' => $normalisasi,
            'terbobot' => $terbobot,
            'hasil' => $hasil
        ]);
    }

    public function hasil(Periode $periode) 
    {
        $hasil = ProsesPerhitungan::with('alternatif')
                ->where('id_periode', $periode->id)
                ->orderBy('peringkat', 'ASC')
                ->get();

        if ($hasil->isEmpty()) {
            return redirect()
                ->route('periode.perhitungan.index', $periode->id)
                ->with('error', 'Silakan lakukan proses perhitungan terlebih dahulu');
        }

        $penilaians = Penilaian::where('id_periode', $periode->id)->get();
        $kriterias = Kriteria::all();
        $alternatifs = $penilaians->pluck('alternatif')->unique('id')->values();

        // 1. Matrix Keputusan
        $matrix = [];
        foreach($penilaians as $p) {
            $matrix[$p->id_alternatif][$p->id_kriteria] = $p->nilai;
        }

        // 2. Normalisasi
        $normalisasi = [];
        foreach($kriterias as $k) {
            $sumKuadrat = 0;
            foreach ($matrix as $altId => $nilaiAlt) {
                $nilaiKriteria = $nilaiAlt[$k->id] ?? 0;
                $sumKuadrat += pow($nilaiKriteria, 2);
            }
            
            $pembagi = sqrt($sumKuadrat);
            
            foreach ($matrix as $altId => $nilaiAlt) {
                $nilaiKriteria = $nilaiAlt[$k->id] ?? 0;
                $normalisasi[$altId][$k->id] = $pembagi == 0 ? 0 : $nilaiKriteria / $pembagi;
            }
        }

        // 3. Normalisasi Terbobot
        $terbobot = [];
        foreach($normalisasi as $altId => $nilaiNorm) {
            foreach($kriterias as $k) {
                $bobotFloat = floatval($k->bobot);
                $bobotFix = $bobotFloat > 1 ? $bobotFloat / 100 : $bobotFloat;
                
                $terbobot[$altId][$k->id] = ($nilaiNorm[$k->id] ?? 0) * $bobotFix;
            }
        }

        // 4. Perhitungan Yi (Benefit - Cost)
        $optimasi = [];
        foreach($terbobot as $altId => $nilaiTerbobot) {
            $benefit = 0;
            $cost = 0;

            foreach($kriterias as $k) {
                $nilai = $nilaiTerbobot[$k->id] ?? 0;
                $jenisKriteria = strtolower(trim($k->jenis));
                
                if ($jenisKriteria === 'benefit') {
                    $benefit += $nilai;
                } else {
                    $cost += $nilai;
                }
            }
            
            $optimasi[$altId] = [
                'benefit' => $benefit,
                'cost' => $cost,
                'yi' => $benefit - $cost
            ];
        }

        return view('perhitungan.hasil', compact(
            'periode', 
            'hasil', 
            'matrix', 
            'normalisasi', 
            'terbobot', 
            'optimasi',
            'kriterias',
            'alternatifs'
        ));
    }

    public function laporan(Periode $periode)
    {
        $laporanHasil = ProsesPerhitungan::with('alternatif')
            ->where('id_periode',$periode->id)
            ->orderBy('peringkat','ASC')
            ->get();
        
        if ($laporanHasil->isEmpty()) {
            return redirect()
                ->route('periode.perhitungan.index',$periode->id)
                ->with('errr','Data laporan belum tersedia');
        }
        return view('perhitungan.laporan',compact('periode','laporanHasil'));
    }
}
