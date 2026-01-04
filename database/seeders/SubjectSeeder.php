<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubjectSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('subjects')->insert([
            ['name' => 'Matematika'],
            ['name' => 'Fisika'],
            ['name' => 'Biologi'],
            ['name' => 'Kimia'],
            ['name' => 'Bahasa Indonesia'],
            ['name' => 'Bahasa Inggris'],
        ]);
    }
}
