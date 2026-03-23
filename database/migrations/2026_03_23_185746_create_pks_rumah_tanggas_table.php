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
        Schema::create('pks_rumah_tanggas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('keluarga_id')->constrained('keluargas')->cascadeOnDelete();
            $table->date('tanggal');
            $table->time('jam')->default('18:00');
            $table->string('pelayan_firman')->comment('Pengkhotbah');
            $table->string('liturgos')->nullable()->comment('Pemimpin Pujian');
            $table->string('pemusik')->nullable();
            $table->text('tema')->nullable();
            $table->string('sektor')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pks_rumah_tanggas');
    }
};
