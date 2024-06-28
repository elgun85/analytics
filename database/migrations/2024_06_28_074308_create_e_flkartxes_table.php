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
        Schema::create('e_flkartxes', function (Blueprint $table) {
            $table->id();
            $table->integer('NOTEL')->nullable();
            $table->integer('KODQURUM')->nullable();
            $table->integer('KODTARIF')->nullable();
            $table->integer('NONARYAD')->nullable();
            $table->string('DTNARYAD')->nullable();
            $table->string('DTNARYAD1')->nullable();
            $table->string('DCORR')->nullable();
            $table->decimal('SUMMA')->nullable();
            $table->integer('ABONENT')->nullable();
            $table->integer('KODIST')->nullable();
            $table->integer('SAY')->nullable();

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
        Schema::dropIfExists('e_flkartxes');
    }
};
