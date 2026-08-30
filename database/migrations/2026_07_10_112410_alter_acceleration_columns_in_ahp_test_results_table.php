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
        Schema::table('ahp_test_results', function (Blueprint $table) {
            $table->decimal('initial_acceleration', 8, 3)->nullable()->change();
            $table->decimal('acceleration_phase', 8, 3)->nullable()->change();
            $table->decimal('maximal_speed', 8, 3)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ahp_test_results', function (Blueprint $table) {
            $table->decimal('initial_acceleration', 5, 3)->nullable()->change();
            $table->decimal('acceleration_phase', 5, 3)->nullable()->change();
            $table->decimal('maximal_speed', 5, 3)->nullable()->change();
        });
    }
};
