<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;
use Spatie\Permission\Models\Role;

return new class extends Migration
{
    public function up(): void
    {
        // Ensure standard roles exist
        Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);
        Role::firstOrCreate(['name' => 'koordinator_inventaris', 'guard_name' => 'web']);
        Role::firstOrCreate(['name' => 'anggota', 'guard_name' => 'web']);

        // Migrate old roles
        $users = User::all();
        foreach ($users as $user) {
            $roleName = $user->role;
            if ($roleName === 'pengurus') {
                $roleName = 'koordinator_inventaris';
            }
            if ($roleName) {
                Role::firstOrCreate(['name' => $roleName, 'guard_name' => 'web']);
                $user->assignRole($roleName);
            }
        }

        // Drop column
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('role');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('role')->default('anggota');
        });
    }
};
