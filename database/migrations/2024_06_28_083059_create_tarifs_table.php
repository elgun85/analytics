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
        Schema::create('tarifs', function (Blueprint $table) {
            $table->id();
            $table->integer('kod')->unique();
            $table->string('name');
            $table->string('mebleg')->nullable();
            $table->string('mebleg_q')->nullable();
            $table->string('category')->nullable();
            $table->string('hamisi')->default('all');
            $table->string('qeyd1')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tarifs');
    }
};
