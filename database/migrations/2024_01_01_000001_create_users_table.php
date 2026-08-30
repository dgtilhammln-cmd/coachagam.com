<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique()->nullable(); // Untuk organizer
            $table->string('participant_id', 50)->unique()->nullable(); // Untuk peserta login
            $table->string('password');
            $table->enum('role', ['organizer', 'participant']);
            $table->boolean('is_active')->default(true);
            $table->timestamp('last_login_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();

            $table->index('role');
            $table->index('participant_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
