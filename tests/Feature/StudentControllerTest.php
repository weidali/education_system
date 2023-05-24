<?php

namespace Tests\Feature;

use App\Models\Student;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StudentControllerTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    /** @test */
    public function test_1_get_list_of_all_students()
    {
        $response = $this->get('api/v1/students');
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
        $response = $this->get('api/v1/students/' . $student->id);
        $expected = [
            'name',
            'created',
            'classroom',
        ];

        $response->assertStatus(200);
        $response->assertJsonStructure($expected);
    }
}
