<?php

use Illuminate\Database\Migrations\Migration;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // 1. Role Pengurus (Akses lintas semua panel)
        $pengurus = Role::firstOrCreate(['name' => 'pengurus', 'guard_name' => 'web']);

        // 2. Role Koordinator Kegiatan (Fokus manajemen event)
        $koorKegiatan = Role::firstOrCreate(['name' => 'koordinator_kegiatan', 'guard_name' => 'web']);
        $koorKegiatan->syncPermissions([
            'view_event',
            'create_event',
            'edit_event',
            'delete_event',
            'view_documentation',
        ]);

        // 3. Update Role PDD (Fokus dokumentasi, hanya baca data event)
        $pdd = Role::firstOrCreate(['name' => 'pdd', 'guard_name' => 'web']);
        $pdd->syncPermissions([
            'view_event',
            'view_documentation',
            'create_documentation',
            'edit_documentation',
            'delete_documentation',
        ]);

        // Berikan semua permissions event, inventaris, pengurus ke role pengurus
        $allPermissions = Permission::whereIn('name', [
            'view_event', 'create_event', 'edit_event', 'delete_event',
            'view_documentation', 'create_documentation', 'edit_documentation', 'delete_documentation',
            'view_pengurus',
            'view_inventaris', 'create_inventaris', 'edit_inventaris',
            'view_transaksi', 'create_transaksi',
            'view_laporan', 'create_laporan',
        ])->get();
        $pengurus->syncPermissions($allPermissions);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Role::where('name', 'koordinator_kegiatan')->delete();
        Role::where('name', 'pengurus')->delete();
    }
};
