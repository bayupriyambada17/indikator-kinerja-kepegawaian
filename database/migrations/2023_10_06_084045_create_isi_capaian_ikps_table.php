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
        Schema::create('isi_capaian_ikp', function (Blueprint $table) {
            $table->id();
            $table->foreignId('years_id')->constrained('years')->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('capaian_indikator_ikp_id')->constrained('capaian_indikator_ikp')->onUpdate('cascade')
                ->onDelete('cascade');
            $table->text('comment')->nullable();
            $table->boolean('isValid')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('isi_capaian_ikps');
    }
};
