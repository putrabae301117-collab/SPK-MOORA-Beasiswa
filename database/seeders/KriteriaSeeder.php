<?php

namespace Database\Seeders;

use App\Models\Kriteria;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KriteriaSeeder extends Seeder
{
    public function run(): void
    {
        Kriteria::create([
            'nama_kriteria' => 'Nilai Rata-rata Raport',
            'bobot' => '30.00',
            'jenis' => 'benefit'
           
        ]);
        Kriteria::create([
            'nama_kriteria' => 'Nilai Rata-rata Raport',
            'bobot' => '30.00',
            'jenis' => 'benefit'
           
        ]);
        Kriteria::create([
            'nama_kriteria' => 'Nilai Rata-rata Raport',
            'bobot' => '30.00',
            'jenis' => 'benefit'
           
        ]);
        Kriteria::create([
            'nama_kriteria' => 'Nilai Rata-rata Raport',
            'bobot' => '30.00',
            'jenis' => 'benefit'
           
        ]);
    }
}
