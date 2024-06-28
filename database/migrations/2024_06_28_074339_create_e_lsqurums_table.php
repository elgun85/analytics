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
        Schema::create('e_lsqurums', function (Blueprint $table) {
            $table->id();

            $table->integer('KODQURUM')->nullable();
            $table->integer('KODQURUM_U')->nullable();
            $table->string('ADQURUM')->nullable();
            $table->string('E_POST')->nullable();
            $table->string('ADRES')->nullable();
            $table->string('KODBANK')->nullable();
            $table->string('MHESAB')->nullable();
            $table->string('HHESAB')->nullable();
            $table->integer('KATEQOR')->nullable();
            $table->string('VOIN')->nullable();
            $table->string('FLAG')->nullable();
            $table->integer('KODMHM')->nullable();

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
        Schema::dropIfExists('e_lsqurums');
    }
};
