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
        Schema::create('jemaats', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_induk')->unique()->nullable()->comment('Nomor Induk Anggota Jemaat');
            $table->string('nama_lengkap');
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
            $table->string('tempat_lahir')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->text('alamat')->nullable();
            $table->string('sektor')->nullable()->comment('Sektor atau Wilayah Pelayanan');
            $table->enum('status_anggota', ['Aktif', 'Pindah', 'Meninggal'])->default('Aktif');
            $table->boolean('status_baptis')->default(false);
            $table->boolean('status_sidi')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jemaats');
    }
};
