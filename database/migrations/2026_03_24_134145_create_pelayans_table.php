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
        Schema::create('pelayans', function (Blueprint $table) {
            $table->id();
            // 1. Relasi ke Jemaat (Agar tidak ada duplikasi data orang yang sama)
            $table->foreignId('jemaat_id')->nullable()->constrained('jemaats')->nullOnDelete()->comment('Null jika pelayan dari luar (misal: Vikaris atau Tamu)');

            // 2. Data Utama
            $table->string('nama_lengkap')->comment('Nama untuk tampilan/cetakan');
            $table->enum('jabatan', ['Pendeta', 'Vikaris', 'Penatua', 'Diaken', 'Pemusik', 'Karyawan', 'Tamu']);
            $table->string('telepon')->nullable();

            // 3. Masa Bakti & Legalitas (Sangat penting untuk jejak 20 tahun)
            $table->string('nomor_sk')->nullable()->comment('Nomor Surat Keputusan/Tahbisan');
            $table->date('mulai_bertugas')->nullable();
            $table->date('akhir_bertugas')->nullable()->comment('Diisi jika sudah pensiun/berhenti');

            // 4. Keuangan & Status
            $table->decimal('insentif_per_layanan', 15, 2)->default(0)->comment('Nilai uang transport/insentif sekali tugas saat ini');
            $table->boolean('is_aktif')->default(true);

            // 5. Fleksibilitas Masa Depan
            $table->json('metadata')->nullable()->comment('Simpan data tambahan tanpa ubah struktur DB di masa depan');

            $table->softDeletes(); // Wajib ada untuk sistem jangka panjang
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pelayans');
    }
};
