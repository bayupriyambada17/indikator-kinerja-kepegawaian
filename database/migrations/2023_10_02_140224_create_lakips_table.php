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
        Schema::create('lakip', function (Blueprint $table) {
            $table->id();
            $table->foreignId('years_id')->constrained('years')->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('pdf')->nullable();
            $table->string('docs')->nullable();
            $table->dateTime('upload_times');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lakips');
    }
};
