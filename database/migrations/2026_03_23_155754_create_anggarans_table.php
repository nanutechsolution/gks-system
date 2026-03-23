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
        Schema::create('anggarans', function (Blueprint $table) {
            $table->id();
            $table->integer('tahun')->default(2026);
            $table->enum('jenis', ['Pendapatan', 'Belanja']);
            $table->string('kelompok_pos')->nullable()->comment('Header seperti: Insentif Karyawan');
            $table->string('nama_pos'); // Uraian seperti: Mingguan, Sekretaris Jemaat
            $table->decimal('target_per_bulan', 15, 2)->default(0);
            $table->decimal('target_per_tahun', 15, 2);
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anggarans');
    }
};
