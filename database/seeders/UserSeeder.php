<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i=0; $i < 10; $i++) { 
            // Generate ID in 'xx08561xxx' format
            $id_user = random_int(10, 99) . '08561' . random_int(100, 999);

            // Use real-looking name and email
            $email = strtolower(str_replace(' ', '', $faker->name)) . '_' . $id_user . '@student.unud.ac.id';

            DB::table('users')->insert([
                'id_user' => $id_user,
                'email' => $email,
                'password' => bcrypt('Password1!'),
                'role' => 'mahasiswa',
            ]);
        }
    }
}
