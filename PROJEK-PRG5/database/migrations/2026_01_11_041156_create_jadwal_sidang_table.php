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
        Schema::create('jadwal_sidang', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kelompok_id')->constrained('kelompok')->onDelete('cascade');
            $table->date('tanggal');
            $table->time('jam');
            $table->string('lokasi');
            $table->foreignId('ketua_sidang')->constrained('dosen')->onDelete('cascade');
            $table->enum('status', ['menunggu', 'terjadwal', 'selesai'])->default('menunggu');
            $table->boolean('is_locked')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal_sidang');
    }
};
