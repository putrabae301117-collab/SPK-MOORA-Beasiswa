<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('alternatifs', function (Blueprint $table) {
            $table->id();
            $table->string('nama_alternatif');
            $table->unsignedBigInteger('id_periode');
            $table->foreign('id_periode')
                ->references('id')
                ->on('periodes');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('alternatifs');
    }
};
