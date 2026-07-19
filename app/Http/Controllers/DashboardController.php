<?php

namespace App\Http\Controllers;

use App\Models\Alternatif;
use App\Models\Kriteria;
use App\Models\Penilaian;
use App\Models\Periode;
use App\Models\SubKriteria;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $jumlahAlternatif = Alternatif::count();

        $totalKriteria = Kriteria::count();
        $totalSubKriteria = SubKriteria::count();

        $jumlahDinilai = Penilaian::count();

       

        return view('dashboard', compact(
            'jumlahAlternatif',
            'totalKriteria',
            'totalSubKriteria',
            'jumlahDinilai',
        ));
    }
}
