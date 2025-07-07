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

            $name = $faker->name;
            
            // Use real-looking name and email
            $email = strtolower(str_replace(' ', '', $name)) . '_' . $id_user . '@student.unud.ac.id';

            DB::table('users')->insert([
                'id_user' => $id_user,
                'email' => $email,
                'password' => bcrypt('Password1!'),
                'role' => 'mahasiswa',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            DB::table('mahasiswas')->insert([
                'nim' => $id_user,
                'nama' => $name,
                'kelas' => collect(['a', 'b', 'c', 'd', 'e'])->random(),
                'profile_picture' => 'profile_pictures/VSEQaGr33CW7qxYSk2qq10QkyTEQ1mBfnyqW8s3q.png',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            DB::table('nilais')->insert([
                'id_nilai' => $id_user,
                'etika_profesi' => random_int(60, 100),
                'kewarganegaraan' => random_int(60, 100),
                'bahasa_indonesia' => random_int(60, 100),
                'matematika_diskrit_1' => random_int(60, 100),
                'statistika_dasar' => random_int(60, 100),
                'algoritma_pemrograman' => random_int(60, 100),
                'sistem_digital' => random_int(60, 100),
                'matematika_informatika' => random_int(60, 100),
                'pancasila' => random_int(60, 100),
                'pendidikan_agama' => random_int(60, 100),
                'matematika_diskrit_2' => random_int(60, 100),
                'pengantar_probabilitas' => random_int(60, 100),
                'kewirausahaan' => random_int(60, 100),
                'tata_tulis_karya_ilmiah' => random_int(60, 100),
                'struktur_data' => random_int(60, 100),
                'sistem_operasi' => random_int(60, 100),
                'organisasi_arsitektur_komputer' => random_int(60, 100),
                'interaksi_manusia_komputer' => random_int(60, 100),
                'basis_data' => random_int(60, 100),
                'desain_analisis_algoritma' => random_int(60, 100),
                'rekayasa_perangkat_lunak' => random_int(60, 100),
                'pemrograman_berorientasi_obyek' => random_int(60, 100),
                'komunikasi_data_jaringan_komputer' => random_int(60, 100),
                'teori_bahasa_otomata' => random_int(60, 100),
                'transkrip_sementara' => 'transkrip_files/uo5AqL0OkoNix6LGtWdG5VD70DuuVgVe5HNY61s1.pdf',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            for ($j=1; $j < 10; $j++) { 
                for ($k=0; $k < 5; $k++) { 
                    DB::table('portofolios')->insert([
                        'nim' => $id_user,
                        'tanggal_mulai' => $faker->date,
                        'tanggal_berakhir' => $faker->date,
                        'nama_kegiatan' => $faker->sentence(4),
                        'tempat_kegiatan' => $faker->address(),
                        'bukti' => 'bukti_sertifikat_mahasiswa/F8oRNPRooP3WT7Z4hMl7R6FYnkRoTORnRUDRwWbI.pdf',
                        'bobot' => 1,
                        'jalur' => 'J' . $j,
                        'status' => 'pending',
                        'action' => 'locked',
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        }

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
