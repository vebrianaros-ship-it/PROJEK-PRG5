<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('jadwal_demo', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kelompok_id')->constrained('kelompok')->onDelete('cascade');
            $table->date('tanggal');
            $table->time('jam');
            $table->string('lokasi');
            $table->foreignId('ketua_demo')->constrained('dosen')->onDelete('cascade');
            $table->foreignId('penguji1')->constrained('dosen')->onDelete('cascade');
            $table->foreignId('penguji2')->constrained('dosen')->onDelete('cascade');
            $table->foreignId('penguji3')->nullable()->constrained('dosen')->onDelete('cascade');
            $table->enum('status', ['menunggu', 'terjadwal', 'selesai'])->default('menunggu');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal_demo');
    }
};
