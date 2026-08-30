<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ahp_test_sessions', function (Blueprint $table) {
            $table->id();
            $table->string('label', 100);
            $table->string('location')->nullable();
            $table->date('test_date');
            $table->time('test_time')->nullable();
            $table->string('temperature', 50)->nullable();
            $table->integer('period_week')->nullable();
            $table->text('coach_notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ahp_test_sessions');
    }
};
