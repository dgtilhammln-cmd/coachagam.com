<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('round_banks', function (Blueprint $table) {
            $table->foreignId('round_id')->constrained()->cascadeOnDelete();
            $table->foreignId('bank_id')->constrained('question_banks')->cascadeOnDelete();
            $table->integer('question_count')->default(10);

            $table->primary(['round_id', 'bank_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('round_banks');
    }
};
