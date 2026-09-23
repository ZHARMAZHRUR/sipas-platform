<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            [
                'name' => 'Super Admin',
                'description' => 'Memiliki akses penuh ke seluruh sistem.',
            ],
            [
                'name' => 'Admin Pondok',
                'description' => 'Mengelola administrasi pondok.',
            ],
            [
                'name' => 'Musyrif',
                'description' => 'Mengelola santri putra.',
            ],
            [
                'name' => 'Musyrifah',
                'description' => 'Mengelola santri putri.',
            ],
            [
                'name' => 'Santri',
                'description' => 'Pengguna utama sistem akses terbatas.',
            ],
        ];

        foreach ($roles as $role) {
            Role::firstOrCreate(
                ['name' => $role['name']],
                ['description' => $role['description']]
            );
        }
    }
}