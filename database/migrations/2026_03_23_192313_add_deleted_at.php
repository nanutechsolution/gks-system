<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Menambahkan fitur Soft Deletes ke tabel inti untuk keamanan data jangka panjang.
     */
    public function up(): void
    {
        // Menambahkan deleted_at ke tabel Keuangan
        Schema::table('keuangans', function (Blueprint $table) {
            $table->softDeletes();
        });

        // Menambahkan deleted_at ke tabel Jemaat
        Schema::table('jemaats', function (Blueprint $table) {
            $table->softDeletes();
        });

        // Menambahkan deleted_at ke tabel Keluarga
        Schema::table('keluargas', function (Blueprint $table) {
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('keuangans', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('jemaats', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('keluargas', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
};