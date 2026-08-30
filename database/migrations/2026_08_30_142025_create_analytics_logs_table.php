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
        Schema::create('analytics_logs', function (Blueprint $table) {
            $table->id();
            $table->string('type', 50)->index(); // 'visitor', 'wa_click', 'lead'
            $table->string('ip_address', 45)->nullable()->index();
            $table->text('user_agent')->nullable();
            $table->string('url')->nullable();
            $table->string('source')->nullable(); // e.g. "footer_wa", "contact_form"
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('analytics_logs');
    }
};
