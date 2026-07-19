<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alternatif extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_alternatif',
        'id_periode',
    ];

    public function periode()
    {
        return $this->belongsTo(Periode::class);
    }

    public function penilaians()
    {
        return $this->hasMany(Penilaian::class);
    }

    public function prosesperhitungan()
    {
        return $this->hasMany(ProsesPerhitungan::class);
    }
}
