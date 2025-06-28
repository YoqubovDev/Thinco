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
        Schema::create('reward_systems', function (Blueprint $table) {
            $table->id();
            $table->string('main_prize')->nullable();
            $table->string('bonus_prize')->nullable();
            $table->string('max_prize')->nullable();
            $table->string('badge_reward')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reward_systems');
    }
};
