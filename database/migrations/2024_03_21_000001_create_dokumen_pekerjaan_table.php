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
        Schema::create('dokumen_pekerjaan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pekerjaan_id')->constrained('pekerjaan')->onDelete('cascade');
            $table->string('nama_dokumen');
            $table->text('url_dokumen');
            $table->string('tipe_dokumen')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dokumen_pekerjaan');
    }
};
