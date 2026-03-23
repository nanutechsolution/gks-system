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
        Schema::create('inventaris', function (Blueprint $table) {
            $table->id();
            $table->string('kode_barang')->unique()->nullable();
            $table->string('nama_barang');
            $table->string('kategori')->comment('Elektronik, Musik, Mebeul, Alat Kebersihan, dll');
            $table->integer('jumlah')->default(1);
            $table->string('satuan')->default('Unit'); // Unit, Set, Buah, dll
            $table->enum('kondisi', ['Baik', 'Rusak Ringan', 'Rusak Berat'])->default('Baik');
            $table->string('lokasi')->nullable()->comment('Contoh: Ruang Pastori, Gedung Utama, Gudang');
            $table->date('tanggal_perolehan')->nullable();
            $table->string('foto_barang')->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventaris');
    }
};
