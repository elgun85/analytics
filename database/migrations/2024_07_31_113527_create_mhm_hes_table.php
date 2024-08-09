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
        Schema::create('mhm_hes', function (Blueprint $table) {
            $table->id();
            $table->integer('kodqurum')->nullable();
            $table->integer('notel')->nullable();
            $table->integer('abonent')->nullable();
            $table->decimal('summa')->nullable();
            $table->integer('ay')->nullable();
            $table->integer('il')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mhm_hes');
    }
};
