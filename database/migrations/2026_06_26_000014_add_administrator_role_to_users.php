<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Ubah enum role users → tambah 'administrator'.
     * Jika tabel belum ada, cukup lewati (migration 000001 akan handle).
     */
    public function up(): void
    {
        if (!Schema::hasTable('users')) return;

        // MySQL: ALTER COLUMN enum
        DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('administrator','organizer','participant') NOT NULL DEFAULT 'participant'");

        // Seed satu akun administrator default (jika belum ada)
        if (DB::table('users')->where('role', 'administrator')->doesntExist()) {
            DB::table('users')->insert([
                'name'       => 'Administrator',
                'email'      => 'admin@coachagam.com',
                'password'   => bcrypt('Admin@2025'),
                'role'       => 'administrator',
                'is_active'  => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    public function down(): void
    {
        if (!Schema::hasTable('users')) return;
        DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('organizer','participant') NOT NULL DEFAULT 'participant'");
    }
};
