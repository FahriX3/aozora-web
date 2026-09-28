<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Daftar permissions
        $permissions = [
            // Event
            'view_event',
            'create_event',
            'edit_event',
            'delete_event',

            // User
            'view_user',
            'create_user',
            'edit_user',
            'delete_user',

            // Pengurus
            'view_pengurus',
            'create_pengurus',
            'edit_pengurus',
            'delete_pengurus',

            // Role
            'view_role',
            'create_role',
            'edit_role',
            'delete_role',

            // Inventaris
            'view_inventaris',
            'create_inventaris',
            'edit_inventaris',
            'delete_inventaris',

            // Transaksi Inventaris
            'view_transaksi',
            'create_transaksi',

            // Laporan Kerusakan
            'view_laporan',
            'create_laporan',
            'update_status_laporan',
        ];

        foreach ($permissions as $permissionName) {
            Permission::firstOrCreate(['name' => $permissionName, 'guard_name' => 'web']);
        }

        // Roles & assignment
        // 1. Super Admin: full access
        $superAdmin = Role::firstOrCreate(['name' => 'super_admin', 'guard_name' => 'web']);
        $superAdmin->syncPermissions(Permission::all());

        // 2. Admin: manajemen event, pengurus, user
        $admin = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);
        $admin->syncPermissions([
            'view_event',
            'create_event',
            'edit_event',
            'delete_event',
            'view_user',
            'create_user',
            'edit_user',
            'view_pengurus',
            'create_pengurus',
            'edit_pengurus',
            'delete_pengurus',
        ]);

        // 3. Koordinator Inventaris
        $koorInventaris = Role::firstOrCreate(['name' => 'koordinator_inventaris', 'guard_name' => 'web']);
        $koorInventaris->syncPermissions([
            'view_inventaris',
            'create_inventaris',
            'edit_inventaris',
            'delete_inventaris',
            'view_transaksi',
            'create_transaksi',
            'view_laporan',
            'create_laporan',
            'update_status_laporan',
        ]);

        // 4. Anggota
        $anggota = Role::firstOrCreate(['name' => 'anggota', 'guard_name' => 'web']);
        $anggota->syncPermissions([
            'view_inventaris',
            'view_laporan',
            'create_laporan',
        ]);
    }
}
