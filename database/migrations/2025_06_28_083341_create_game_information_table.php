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
        Schema::create('game_information', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('short_description');
            $table->string('long_description');
            $table->integer('min_age')->nullable();
            $table->integer('max_age')->nullable();
            $table->enum('difficulty', ['easy', 'medium', 'hard'])->nullable();
            $table->string('game_rules');
            $table->string('game_start');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('game_information');
    }
};
