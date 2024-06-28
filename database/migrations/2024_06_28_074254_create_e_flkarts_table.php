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
        Schema::create('e_flkarts', function (Blueprint $table) {
            $table->id();
            $table->integer('NOTEL')->nullable();
            $table->integer('KODQURUM')->nullable();
            $table->integer('X_KART')->nullable();
            $table->integer('KODTARIF')->nullable();
            $table->integer('RENTA')->nullable();
            $table->integer('KODLQOT')->nullable();
            $table->integer('ABONENT')->nullable();
            $table->integer('ABONENT2')->nullable();
            $table->integer('SAYTEL')->nullable();
            $table->decimal('SUMMA0')->nullable();
            $table->decimal('SUMMA')->nullable();
            $table->integer('NONARYAD')->nullable();
            $table->integer('UZEL')->nullable();
            $table->string('DTNARYAD')->nullable();
            $table->string('DTNARYAD1')->nullable();
            $table->string('TMNARYAD1')->nullable();
            $table->string('DTNARYAD2')->nullable();
            $table->integer('KODXIDMET')->nullable();
            $table->integer('KODIST')->nullable();
            $table->integer('AD_UCRET_K')->nullable();
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
        Schema::dropIfExists('e_flkarts');
    }
};
