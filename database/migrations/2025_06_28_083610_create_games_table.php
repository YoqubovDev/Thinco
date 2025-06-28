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
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->foreignId('type_game_id')->constrained('type_games');
            $table->foreignId('category_id')->constrained('category_games')->cascadeOnDelete();
            $table->foreignId('game_information_id')->constrained('game_information')->cascadeOnDelete();
            $table->foreignId('reward_id')->constrained('reward_systems')->cascadeOnDelete();
            $table->foreignId('game_setting_id')->constrained('game_settings')->cascadeOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('games');
    }
};
