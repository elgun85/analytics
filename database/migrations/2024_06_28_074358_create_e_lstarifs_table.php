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
        Schema::create('e_lstarifs', function (Blueprint $table) {
            $table->id();

            $table->integer('KODTARIF')->nullable();
            $table->string('ADTARIF')->nullable();
            $table->integer('RENTA')->nullable();
            $table->decimal('A_ATS_A')->nullable();
            $table->decimal('A_ATS_E')->nullable();
            $table->decimal('B_ATS_A')->nullable();
            $table->decimal('B_ATS_E')->nullable();
            $table->decimal('C_ATS_A')->nullable();
            $table->decimal('C_ATS_E')->nullable();
            $table->integer('KODISH')->nullable();
            $table->integer('DEAKTIVE')->nullable();

            $table->integer('AY')->nullable();
            $table->integer('Il')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('e_lstarifs');
    }
};
