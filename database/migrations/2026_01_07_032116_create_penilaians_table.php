<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('penilaians', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_periode');
            $table->foreign('id_periode')->references('id')->on('periodes');
            $table->unsignedBigInteger('id_alternatif');
            $table->foreign('id_alternatif')->references('id')->on('alternatifs');
            $table->unsignedBigInteger('id_kriteria');
            $table->foreign('id_kriteria')->references('id')->on('kriterias');
            $table->unsignedBigInteger('id_subkriteria');
            $table->foreign('id_subkriteria')->references('id')->on('sub_kriterias');
            $table->double('nilai');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('penilaians');
    }
};
