<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubjectSeeder extends Seeder
{
    public function run(): void
    {
    DB::table('subjects')->insert([
        ['name' => 'Matematika', 'teacher_id' => 1],
        ['name' => 'Fisika', 'teacher_id' => 2],
        ['name' => 'Biologi', 'teacher_id' => 3],
        ['name' => 'Kimia', 'teacher_id' => 4],
        ['name' => 'Bahasa Indonesia', 'teacher_id' => 5],
        ['name' => 'Bahasa Inggris', 'teacher_id' => 6],
    ]);
    }
}
