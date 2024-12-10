<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user1 = User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
        ]);
        User::factory()->create([
            'name' => 'Usuario',
            'email' => 'usuario@gmail.com',
        ]);
        $role = Role::create(['name' => 'Admin']);
        $user1->assignRole($role);

    }
}
