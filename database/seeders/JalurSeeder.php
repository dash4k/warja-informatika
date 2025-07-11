<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Illuminate\Support\Arr;

class JalurSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        
        $name = [
            'Text Mining',
            'Web',
            'Music',
            'Multimedia',
            'Cybersecurity',
            'IoT',
            'Smart Computing',
            'Big Data',
            'UI/UX'
        ];

        for ($i=0; $i < 9; $i++) { 
            DB::table('jalurs')->insert([
                'id_jalur' => 'J' . ($i+1),
                'nama' => $name[$i],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
        
        $jalur = [
            'J1',
            'J2',
            'J3',
            'J4',
            'J5',
            'J6',
            'J7',
            'J8',
            'J9',
        ];

        foreach ($jalur as $value) {
            for ($i = 0; $i < 5; $i++) {
                DB::table('soal_penjalurans')->insert([
                    'id_jalur' => $value,
                    'pertanyaan' => $faker->sentence(),
                    'pilihan' => json_encode([
                        'A' => $faker->sentence(),
                        'B' => $faker->sentence(),
                        'C' => $faker->sentence(),
                        'D' => $faker->sentence(),
                    ]),
                    'jawaban' => Arr::random(['A', 'B', 'C', 'D']),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
