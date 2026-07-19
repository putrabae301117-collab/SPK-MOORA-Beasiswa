<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penilaian extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_periode',
        'id_alternatif',
        'id_kriteria',
        'id_subkriteria',
        'nilai',
    ];

    public function periode()
    {
        return $this->belongsTo(Periode::class);
    }

    public function alternatif()
    {
        return $this->belongsTo(Alternatif::class, 'id_alternatif');
    }

    public function kriteria()
    {
        return $this->belongsTo(Kriteria::class, 'id_kriteria');
    }

    public function subkriteria()
    {
        return $this->belongsTo(SubKriteria::class, 'id_subkriteria');
    }
}
