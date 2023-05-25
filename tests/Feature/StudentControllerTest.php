<?php

namespace Tests\Feature;

use App\Models\Classroom;
use App\Models\Student;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Arr;
use Tests\TestCase;

class StudentControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    /** @test */
    public function test_1_get_list_of_all_students()
    {
        $response = $this->getJson('api/v1/students');
        $expected = [
            '*' => [
                'name',
                'created',
            ],
        ];
        $response->assertStatus(200);
        $response->assertJsonStructure($expected);
    }

    /** @test */
    public function test_2_get_the_student_with_classroom_field()
    {
        $student = Student::inRandomOrder()->first();
        $response = $this->getJson('api/v1/students/' . $student->id);
        $expected = [
            'name',
            'created',
            'classroom',
        ];

        $response->assertStatus(200);
        $response->assertJsonStructure($expected);
    }

    /** @test */
    public function test_3_store_the_student()
    {
        $credentials = $this->makeTestingStudentCredentials();

        $response = $this->postJson('api/v1/students/', $credentials);

        $expected = [
            'name',
            'email',
            'created',
            'classroom',
        ];

        $response->assertStatus(200);
        $response->assertJsonStructure($expected);
    }

    /** @test */
    public function test_3_1_store_the_student_with_validation()
    {
        $empty_credentials = [];
        $response = $this->postJson('api/v1/students/', $empty_credentials);
        $response->assertStatus(422);

        $student = $this->getRandomStudent();
        $exist_email_credentials = $this->makeTestingStudentCredentials($student->email);

        $response = $this->postJson('api/v1/students/', $exist_email_credentials);
        $response->assertStatus(422);
        $expected = [
            'errors' => [
                'email'
            ],
        ];
        $response->assertJsonStructure($expected);
    }

    /** @test */
    public function test_5_destroy_the_student()
    {
        $student = $this->getRandomStudent();

        $response = $this->deleteJson('api/v1/students/' . $student->id);
        $response->assertStatus(204);
    }

    public function getRandomStudent(): Student
    {
        $student = Student::inRandomOrder()->first();
        if (!$student) {
            $student = Student::factory()->create();
        }
        return $student;
    }

    public function makeTestingStudentCredentials(string $email = null): array
    {
        $classroom = Classroom::inRandomOrder()->first();
        if (!$classroom) {
            $classroom = Classroom::factory()->create();
        }
        $classroom_id = $classroom ? $classroom->id : null;

        $full_name = $this->faker->firstName . ' ' . $this->faker->lastName;
        return [
            'name' => $full_name,
            'email' => $email ?? $this->faker->email,
            'classroom_id' => Arr::random([null, $classroom_id]),
        ];
    }
}
