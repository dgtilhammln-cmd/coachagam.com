<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('exam_questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('session_id')->constrained('exam_sessions')->cascadeOnDelete();
            $table->foreignId('question_id')->constrained()->cascadeOnDelete();
            $table->integer('display_order');
            $table->json('shuffled_options')->nullable(); // [option_id, option_id, ...]

            $table->unique(['session_id', 'question_id']);
            $table->index(['session_id', 'display_order']);
        });

        Schema::create('answers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('session_id')->constrained('exam_sessions')->cascadeOnDelete();
            $table->foreignId('question_id')->constrained()->cascadeOnDelete();
            // Pilihan ganda
            $table->foreignId('selected_option_id')->nullable()->constrained('options')->nullOnDelete();
            $table->boolean('is_correct')->nullable();
            $table->decimal('score', 8, 2)->default(0);
            // Esai
            $table->longText('essay_answer')->nullable();
            $table->text('essay_feedback')->nullable();
            $table->enum('essay_status', ['pending', 'graded'])->default('pending');
            $table->dateTime('graded_at')->nullable();
            $table->foreignId('graded_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('answered_at')->nullable();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();

            $table->unique(['session_id', 'question_id']);
            $table->index('session_id');
            $table->index('essay_status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('answers');
        Schema::dropIfExists('exam_questions');
    }
};
