<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration ini hanya membuang kolom 'role' lama dari tabel users.
 * Logika assign role ke Spatie dipindah ke seeder (RolePermissionSeeder + AdminSeeder)
 * agar tidak konflik saat migrate:fresh.
 */
return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasColumn('users', 'role')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('role');
            });
        }
    }

    public function down(): void
    {
        if (!Schema::hasColumn('users', 'role')) {
            Schema::table('users', function (Blueprint $table) {
                $table->string('role')->default('anggota')->after('email');
            });
        }
    }
};
