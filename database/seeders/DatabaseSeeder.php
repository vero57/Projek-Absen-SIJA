<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            ParentSeeder::class,
            ClassSeeder::class,
            SubjectSeeder::class,
            AttendanceStatusSeeder::class,
            ViolationRuleSeeder::class
            // WaSettingSeeder::class,
        ]);
    }
}
