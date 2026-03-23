<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Jalankan seeder untuk membuat user awal berdasarkan peran di GKS.
     */
    public function run(): void
    {
        // 1. Pastikan Role dasar sudah ada di database
        // Jika Anda sudah menjalankan shield:install, role ini biasanya sudah ada
        $roles = ['super_admin', 'pendeta', 'keuangan'];

        foreach ($roles as $roleName) {
            Role::firstOrCreate(['name' => $roleName, 'guard_name' => 'web']);
        }

        // 2. Membuat User Super Admin
        $superAdmin = User::firstOrCreate(
            ['email' => 'admin@gks.com'],
            [
                'name' => 'Super Admin GKS',
                'password' => Hash::make('password'), // Password default: password
            ]
        );
        $superAdmin->assignRole('super_admin');

        // 3. Membuat User Pendeta (Sesuai dengan data di dokumen Anggaran)
        $pendeta = User::firstOrCreate(
            ['email' => 'pendeta@gks.com'],
            [
                'name' => 'Pdt. Alponia Malo, S.Th',
                'password' => Hash::make('password'),
            ]
        );
        $pendeta->assignRole('pendeta');

        // 4. Membuat User Keuangan (Bendahara)
        $keuangan = User::firstOrCreate(
            ['email' => 'bendahara@gks.com'],
            [
                'name' => 'Bendahara Jemaat',
                'password' => Hash::make('password'),
            ]
        );
        $keuangan->assignRole('keuangan');
    }
}
