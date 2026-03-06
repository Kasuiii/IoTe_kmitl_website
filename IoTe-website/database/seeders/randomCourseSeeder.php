<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Course;


class randomCourseSeeder extends Seeder
{
    public function run(): void
    {
        Course::factory()->count(10)->create(); //using coursefactory from courseFactory.php
    }
}
