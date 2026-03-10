<?php

namespace Database\Seeders;

use App\Models\User;
use Database\Factories\courseFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(randomCourseSeeder::class);
        $this->call(StarterFacultyMember::class);
        $this->call(ReservableItemSeeder::class);
        $this->call(AdmissionSeeder::class);
    }
}
