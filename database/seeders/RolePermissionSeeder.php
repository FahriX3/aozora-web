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

            // Dokumentasi & Galeri (PDD)
            'view_documentation',
            'create_documentation',
            'edit_documentation',
            'delete_documentation',
        ];

        foreach ($permissions as $permissionName) {
            Permission::firstOrCreate(['name' => $permissionName, 'guard_name' => 'web']);
        }

        // Roles & assignment
        // 1. Super Admin: full access
        $superAdmin = Role::firstOrCreate(['name' => 'super_admin', 'guard_name' => 'web']);
        $superAdmin->syncPermissions(Permission::all());

        // 2. Admin: manajemen event, pengurus, dokumentasi (TIDAK BISA KELOLA USER & ROLE)
        $admin = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);
        $admin->syncPermissions([
            'view_event',
            'create_event',
            'edit_event',
            'delete_event',
            'view_pengurus',
            'create_pengurus',
            'edit_pengurus',
            'delete_pengurus',
            'view_documentation',
            'create_documentation',
            'edit_documentation',
            'delete_documentation',
        ]);

        // 3. PDD (Publikasi & Dokumentasi): dokumentasi media (read-only event)
        $pdd = Role::firstOrCreate(['name' => 'pdd', 'guard_name' => 'web']);
        $pdd->syncPermissions([
            'view_event',
            'view_documentation',
            'create_documentation',
            'edit_documentation',
            'delete_documentation',
        ]);

        // 4. Koordinator Kegiatan: manajemen event & view dokumentasi
        $koorKegiatan = Role::firstOrCreate(['name' => 'koordinator_kegiatan', 'guard_name' => 'web']);
        $koorKegiatan->syncPermissions([
            'view_event',
            'create_event',
            'edit_event',
            'delete_event',
            'view_documentation',
        ]);

        // 5. Koordinator Inventaris
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

        // 6. Pengurus (Akses lintas portal)
        $pengurus = Role::firstOrCreate(['name' => 'pengurus', 'guard_name' => 'web']);
        $pengurus->syncPermissions([
            'view_event', 'create_event', 'edit_event', 'delete_event',
            'view_documentation', 'create_documentation', 'edit_documentation', 'delete_documentation',
            'view_pengurus',
            'view_inventaris', 'create_inventaris', 'edit_inventaris',
            'view_transaksi', 'create_transaksi',
            'view_laporan', 'create_laporan',
        ]);

        // 7. Anggota
        $anggota = Role::firstOrCreate(['name' => 'anggota', 'guard_name' => 'web']);
        $anggota->syncPermissions([
            'view_inventaris',
            'view_laporan',
            'create_laporan',
        ]);
    }
}

