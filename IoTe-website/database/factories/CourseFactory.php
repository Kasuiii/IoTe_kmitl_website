<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\models\course;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Course>
 */
class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * 
     * @return array<string, mixed>
     */

    protected $model = course::class;

    public function definition(): array
    {
        return [
            'courseYear' => rand(1, 4),
            'courseID' => $this->faker->unique()->bothify('05######'),
            'courseName' => $this->faker->sentence(3),
            'courseCredit' => rand(1, 3),
            'courseType' => $this->faker->randomElement(['Core', 'Elective', 'Gen', 'Lab']),
            'courseDescript' => $this->faker->paragraph(),
            'courseSemester' => $this->faker->randomElement(['1', '2']),
            'courseDegree' => $this->faker->randomElement(['One', 'dual']),
        ];
    }
}
