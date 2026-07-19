<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubKriteria extends Model
{
    use HasFactory;

    protected $table = 'sub_kriterias';

    protected $fillable = [
        'id_kriteria',
        'nama_sub_kriteria',
        'bobot_sub_kriteria',
        'keterangan'
    ];

    public function kriteria()
    {
        return $this->belongsTo(Kriteria::class, 'id_kriteria');
    }

    public function penilaian()
    {
        return $this->belongsTo(Penilaian::class);
    }
}
