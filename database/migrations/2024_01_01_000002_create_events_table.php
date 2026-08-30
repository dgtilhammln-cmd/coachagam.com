<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->foreignId('organizer_id')->constrained('users')->cascadeOnDelete();
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('banner_url', 500)->nullable();
            $table->string('category', 100)->nullable();
            $table->date('start_date');
            $table->date('end_date');
            $table->enum('status', ['draft', 'published', 'ongoing', 'completed', 'cancelled'])->default('draft');
            $table->json('settings')->nullable();
            // settings: {
            //   "show_score_immediately": true,
            //   "show_answer_review": true,
            //   "essay_review_hours": 24,
            //   "certificate_auto_publish": true
            // }
            $table->timestamps();
            $table->softDeletes();

            $table->index(['organizer_id', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
