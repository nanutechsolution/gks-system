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
        Schema::table('jemaats', function (Blueprint $table) {
            $table->foreignId('keluarga_id')->nullable()->after('id')->constrained('keluargas')->nullOnDelete();
            $table->string('hubungan_keluarga')->nullable()->after('keluarga_id')->comment('Kepala Keluarga, Istri, Anak, dll');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('jemaats', function (Blueprint $table) {
            //
        });
    }
};
