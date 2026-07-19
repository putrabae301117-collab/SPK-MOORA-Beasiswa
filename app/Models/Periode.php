<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Periode extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_periode',
        'tanggal',
        'keterangan',
    ];

    public function alternatifs()
    {
        return $this->hasMany(Alternatif::class, 'id_periode');
    }

    public function penilaians()
    {
        return $this->hasMany(Penilaian::class, 'id_periode');
    }

    public function prosesperhitungan()
    {
        return $this->hasMany(ProsesPerhitungan::class);
    }

   
}
