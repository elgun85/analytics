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
        Schema::create('e_lsxitmets', function (Blueprint $table) {
            $table->id();

            $table->integer('KODXIDMET')->nullable();
            $table->string('ADXIDMET')->nullable();
            $table->string('ADXIDMETQ')->nullable();
            $table->string('L_KD_QURUM')->nullable();
            $table->string('L_AD_ABUNE')->nullable();
            $table->string('L_KD_KUCE')->nullable();
            $table->string('L_ABON')->nullable();
            $table->string('L_KD_TARIF')->nullable();
            $table->integer('ABON_OLD')->nullable();
            $table->integer('LS_ABUN')->nullable();
            $table->integer('FL_KART')->nullable();
            $table->integer('TARIX')->nullable();
            $table->string('KASSA')->nullable();
            $table->string('QEBZ')->nullable();
            $table->integer('AAH')->nullable();
            $table->integer('TITLE')->nullable();
            $table->string('FGPRINT')->nullable();
            $table->integer('MINI')->nullable();
            $table->integer('KODX')->nullable();
            $table->integer('KODISH')->nullable();
            $table->integer('DEAKTIVE')->nullable();
            $table->integer('AY')->nullable();
            $table->integer('IL')->nullable();


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('e_lsxitmets');
    }
};
