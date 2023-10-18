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
        Schema::create('isi_target_capaian_retra_uploads', function (Blueprint $table) {
            $table->id();
            $table->foreignId('years_id')->constrained('years')->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('indikator_id')->constrained('indikator')->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('bukti_upload_id')->constrained('bukti_upload')->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('file_upload');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('isi_target_capaian_retra_uploads');
    }
};
