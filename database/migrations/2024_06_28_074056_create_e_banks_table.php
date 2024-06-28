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
        Schema::create('e_banks', function (Blueprint $table) {
            $table->id();
            $table->date('DTEMEL')->format('d/m/Y')->nullable();
            $table->integer('NOKASSA')->nullable();
            $table->integer('NOTEL')->nullable();
            $table->integer('KODQURUM')->nullable();
            $table->integer('KODXIDMET')->nullable();
            $table->decimal('SUMMA',10,2)->nullable();
            $table->integer('KODEMEL')->nullable();
            $table->integer('DOVR1')->nullable();
            $table->integer('DOVR2')->nullable();
            $table->integer('SAYTEL')->nullable();
            $table->integer('AAH')->nullable();
            $table->date('DTEDIT')->format('d/m/Y')->nullable();
            $table->integer('KODIST')->nullable();
            $table->integer('NOATS')->nullable();
            $table->integer('NOQEBZ')->nullable();
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
        Schema::dropIfExists('e_banks');
    }
};
