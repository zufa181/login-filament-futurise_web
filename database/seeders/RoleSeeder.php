<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $roles = array_merge(User::ADMIN_ROLES, [
            'pic-kampus', 'tim-mahasiswa', 'pic-industri',
            'pic-sponsor', 'pic-sekolah', 'juri', 'pengunjung',
        ]);

        foreach ($roles as $role) {
            Role::firstOrCreate(['name' => $role, 'guard_name' => 'web']);
        }

        $admin = User::firstOrCreate(
            ['email' => 'admin@futurisee.com'],
            ['name' => 'Super Admin', 'password' => Hash::make('admin123')]
        );
        $admin->assignRole('super-admin');
    }
}