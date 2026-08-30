<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('violations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('session_id')->constrained('exam_sessions')->cascadeOnDelete();
            $table->enum('type', [
                'tab_switch',
                'window_blur',
                'fullscreen_exit',
                'browser_minimize',
                'copy_attempt',
                'paste_attempt',
                'right_click',
                'keyboard_shortcut'
            ]);
            $table->dateTime('occurred_at');
            $table->json('metadata')->nullable();

            $table->index(['session_id', 'type']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('violations');
    }
};
