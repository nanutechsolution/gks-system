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
        Schema::table('keuangans', function (Blueprint $table) {
            $table->foreignId('rekening_id')->nullable()->after('id')->constrained('rekenings')->nullOnDelete();
            $table->string('bukti_transaksi')->nullable()->after('nominal')->comment('Path foto struk/kwitansi');
            $table->string('referensi')->nullable()->after('bukti_transaksi')->comment('Nomor Kwitansi/Bukti Transfer');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('keuangans', function (Blueprint $table) {
            //
        });
    }
};
