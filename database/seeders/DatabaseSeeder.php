<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{


    public function run(): void
    {
        $adminRole = Role::firstOrCreate(['name' => 'admin']);

        $admin = User::factory()->create([
            'email' => 'admin@admin.com',
            'password' => bcrypt('1234')
        ]);

        $admin->roles()->attach($adminRole);
    }

//    public function run(): void
//    {
//        $this->call([
//            RoleSeeder::class,
//            UserSeeder::class,
//        ]);
//    }
}
