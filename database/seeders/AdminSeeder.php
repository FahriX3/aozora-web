<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Super Admin
        $superAdmin = User::updateOrCreate(
            ['email' => 'admin@aozora.local'],
            [
                'name' => 'Super Admin Aozora',
                'password' => Hash::make('password'),
            ]
        );
        $superAdmin->syncRoles(['super_admin']);

        // 2. Admin Konten / Event
        $admin = User::updateOrCreate(
            ['email' => 'admin_event@aozora.local'],
            [
                'name' => 'Admin Event',
                'password' => Hash::make('password'),
            ]
        );
        $admin->syncRoles(['admin']);

        // 3. Koordinator Inventaris
        $koor = User::updateOrCreate(
            ['email' => 'inventaris@aozora.local'],
            [
                'name' => 'Koordinator Inventaris',
                'password' => Hash::make('password'),
            ]
        );
        $koor->syncRoles(['koordinator_inventaris']);

        // 4. Anggota
        $anggota = User::updateOrCreate(
            ['email' => 'anggota@aozora.local'],
            [
                'name' => 'Anggota Aozora',
                'password' => Hash::make('password'),
            ]
        );
        $anggota->syncRoles(['anggota']);
    }
}
