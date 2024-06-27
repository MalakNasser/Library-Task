<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::Table('students')->insert([
            [
                'id' => 1,
                'name' => 'Ali',
                'email' => 'Ali@enozom.com',
                'phone' => '0122224400',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'name' => 'Mohamed',
                'email' => 'Ali@enozom.com',
                'phone' => '0111155000',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'name' => 'Ahmed',
                'email' => 'Ahmed@enozom.com',
                'phone' => '0155553311',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
