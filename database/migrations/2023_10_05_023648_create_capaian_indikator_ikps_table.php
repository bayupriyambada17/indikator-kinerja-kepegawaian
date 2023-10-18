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
        Schema::create('capaian_indikator_ikp', function (Blueprint $table) {
            $table->id();
            $table->text('name');
            $table->foreignId('satuan_id')->constrained('satuan')->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('faculty_targets')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('capaian_indikator_ikps');
    }
};
