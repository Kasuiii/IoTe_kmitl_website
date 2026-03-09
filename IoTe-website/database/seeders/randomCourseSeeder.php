<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\course;


class randomCourseSeeder extends Seeder
{
    public function run(): void
    {
        course::factory()->count(10)->create(); //using coursefactory from courseFactory.php
    }
}
