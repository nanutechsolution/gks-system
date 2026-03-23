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
        Schema::create('surat_keterangans', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_surat')->unique();
            $table->foreignId('jemaat_id')->constrained('jemaats')->cascadeOnDelete();
            $table->enum('jenis_surat', ['Pindah', 'Anggota Aktif', 'Rekomendasi Nikah', 'Lainnya']);
            $table->text('keperluan')->nullable();
            $table->date('tanggal_surat');
            $table->string('tujuan_surat')->nullable()->comment('Misal: GKS Jemaat Waingapu atau Universitas');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surat_keterangans');
    }
};
