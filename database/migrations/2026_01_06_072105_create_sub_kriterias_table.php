<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sub_kriterias', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_kriteria');
            $table->foreign('id_kriteria')->references('id')->on('kriterias');
            $table->string('nama_sub_kriteria');
            $table->string('bobot_sub_kriteria');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sub_kriterias');
    }
};
