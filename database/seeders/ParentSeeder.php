<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ParentSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('parents')->insert([
            [
                'user_id' => 4, // Ortu
                'student_id' => 3, // Siswa
            ],
        ]);
    }
}
