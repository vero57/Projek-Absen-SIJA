<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClassSubjectSeeder extends Seeder
{
    public function run(): void
    {
        // Contoh relasi: class_id, subject_id, teacher_id
        DB::table('class_subject')->insert([
            // Kelas 1, Matematika, Guru Matematika (user id 2)
            ['class_id' => 1, 'subject_id' => 1, 'teacher_id' => 2],
            // Kelas 1, Fisika, Guru Fisika (user id 3)
            ['class_id' => 1, 'subject_id' => 2, 'teacher_id' => 3],
            // Kelas 1, Biologi, Guru Biologi (user id 4)
            ['class_id' => 1, 'subject_id' => 3, 'teacher_id' => 4],
            // Kelas 2, Kimia, Guru Kimia (user id 5)
            ['class_id' => 2, 'subject_id' => 4, 'teacher_id' => 5],
            // Kelas 2, Bahasa Indonesia, Guru Bahasa Indonesia (user id 6)
            ['class_id' => 2, 'subject_id' => 5, 'teacher_id' => 6],
            // Kelas 2, Bahasa Inggris, Guru Bahasa Inggris (user id 7)
            ['class_id' => 2, 'subject_id' => 6, 'teacher_id' => 7],
        ]);
    }
}
