<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('exam_sessions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('participant_id')->constrained()->cascadeOnDelete();
            $table->foreignId('round_id')->constrained()->cascadeOnDelete();
            $table->string('token', 64)->unique();
            $table->dateTime('started_at')->nullable();
            $table->dateTime('submitted_at')->nullable();
            $table->enum('status', ['pending', 'ongoing', 'submitted', 'auto_submitted'])->default('pending');
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->integer('violation_count')->default(0);
            $table->decimal('score_pg', 10, 2)->default(0);
            $table->decimal('score_essay', 10, 2)->default(0);
            $table->decimal('total_score', 10, 2)->default(0);
            $table->integer('correct_count')->default(0);
            $table->integer('wrong_count')->default(0);
            $table->integer('unanswered_count')->default(0);
            $table->enum('result_status', [
                'pending',
                'pg_scored',
                'essay_pending',
                'final'
            ])->default('pending');
            $table->dateTime('result_published_at')->nullable();
            $table->integer('rank')->nullable();
            $table->timestamps();

            $table->unique(['participant_id', 'round_id']);
            $table->index(['round_id', 'status']);
            $table->index('result_status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('exam_sessions');
    }
};
