<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('proses_perhitungans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_periode');
            $table->foreign('id_periode')->references('id')->on('periodes');
            $table->unsignedBigInteger('id_alternatif');
            $table->foreign('id_alternatif')->references('id')->on('alternatifs');
            $table->double('nilai_yi');
            $table->unsignedInteger('peringkat');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('proses_perhitungans');
    }
};
