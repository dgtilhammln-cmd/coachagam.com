<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ahp_test_results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('player_id')->constrained('ahp_players')->cascadeOnDelete();
            $table->foreignId('session_id')->constrained('ahp_test_sessions')->cascadeOnDelete();
            $table->integer('age')->nullable();
            $table->decimal('height_cm', 5, 2)->nullable();
            $table->decimal('weight_kg', 5, 2)->nullable();
            $table->decimal('bmi', 5, 2)->nullable();
            $table->decimal('body_fat_percentage', 5, 2)->nullable();
            $table->decimal('skeletal_muscle_mass', 5, 2)->nullable();
            $table->integer('moca_score')->nullable();
            $table->integer('total_passing')->nullable();
            $table->integer('passing_sukses')->nullable();
            $table->integer('passing_gagal')->nullable();
            $table->decimal('scanning_per_10sec', 5, 2)->nullable();
            $table->decimal('initial_acceleration', 5, 3)->nullable();
            $table->decimal('acceleration_phase', 5, 3)->nullable();
            $table->decimal('maximal_speed', 5, 3)->nullable();
            $table->decimal('rast_test', 6, 2)->nullable();
            $table->integer('yo_yo_level')->nullable();
            $table->integer('yo_yo_balikan')->nullable();
            $table->decimal('yo_yo_distance', 8, 2)->nullable();
            $table->text('rating_notes')->nullable();
            $table->timestamps();
            $table->unique(['player_id', 'session_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ahp_test_results');
    }
};
