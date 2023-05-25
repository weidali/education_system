<?php

namespace Database\Seeders;

use App\Models\Classroom;
use App\Models\Lecture;
use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LectureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create();

        Lecture::factory(50)->create();
        if (!Classroom::count()) {
            Classroom::factory(10)->create();
        }

        for ($i = 0; $i < 30; $i++) {
            $lecture = Lecture::inRandomOrder()->first();
            $classroom = Classroom::inRandomOrder()->first();

            $classroom->lectures()->attach($lecture->id, [
                'started_at' => $faker->dateTime(),
            ]);
        }
    }
}
