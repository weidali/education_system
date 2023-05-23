<?php

namespace Database\Factories;

use App\Models\Classroom;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $classroom = Classroom::inRandomOrder()->first();
        $classroom_id = $classroom ? $classroom->id : null;
        $full_name = $this->faker->firstName . ' ' . $this->faker->lastName;

        return [
            'name' => $full_name,
            'email' => $this->faker->email,
            'classroom_id' => Arr::random([null, $classroom_id]),
        ];
    }
}
