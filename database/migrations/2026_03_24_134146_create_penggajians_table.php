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
        Schema::create('penggajians', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pelayan_id')->constrained('pelayans')->cascadeOnDelete();
            $table->date('tanggal_bayar');
            $table->string('periode_bulan')->comment('Contoh: Maret 2026');
            $table->integer('total_kehadiran')->default(0);

            // Total insentif di-hardcode agar jika tarif insentif naik 5 tahun lagi, data lama tidak ikut berubah
            $table->decimal('total_insentif', 15, 2)->comment('Total uang yang dibayarkan');
            $table->text('catatan')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penggajians');
    }
};
