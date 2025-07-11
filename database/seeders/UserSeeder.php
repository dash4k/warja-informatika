<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'id_user' => 8888888888,
            'email' => 'admin@student.unud.ac.id',
            'password' => bcrypt('Password1!'),
            'role' => 'admin',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('admins')->insert([
            'id_admin' => 8888888888,
            'nama' => 'Admin',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
