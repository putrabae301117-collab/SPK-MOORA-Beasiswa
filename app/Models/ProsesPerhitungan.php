<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProsesPerhitungan extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_periode',
        'id_alternatif',
        'nilai_yi',
        'peringkat',
    ];

    public function periode()
    {
        return $this->belongsTo(Periode::class);
    }
    public function alternatif()
    {
        return $this->belongsTo(Alternatif::class,'id_alternatif');
    }
}
