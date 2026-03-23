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
        Schema::create('pengaturans', function (Blueprint $table) {
            $table->id();
            $table->string('nama_gereja')->default('GEREJA KRISTEN SUMBA (GKS)');
            $table->string('nama_jemaat')->default('JEMAAT REDA PADA');
            $table->text('alamat_lengkap')->nullable();
            $table->string('kota_surat')->default('Lolo Ole')->comment('Digunakan untuk titi mangsa surat/kuitansi');
            $table->string('nama_ketua_majelis')->nullable()->comment('Contoh: Pdt. Alponia Malo, S.Th');
            $table->string('nama_sekretaris')->nullable()->comment('Contoh: Pnt. Benyamin T. Dona');
            $table->string('logo_gereja')->nullable();
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengaturans');
    }
};
