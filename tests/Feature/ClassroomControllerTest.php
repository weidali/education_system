<?php

namespace Tests\Feature;

use App\Models\Classroom;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ClassroomControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    /** @test */
    public function test_1_get_list_of_all_classrooms()
    {
        $response = $this->getJson('api/v1/classrooms');
        $expected = [
            '*' => [
                'title',
                'created',
            ],
        ];
        $response->assertStatus(200);
        $response->assertJsonStructure($expected);
    }

    /** @test */
    public function test_2_get_the_classroom()
    {
        $classroom = $this->getRandomClassroom();
        $response = $this->getJson('api/v1/classrooms/' . $classroom->id);
        $expected = [
            'title',
            'created',
        ];

        $response->assertStatus(200);
        $response->assertJsonStructure($expected);
    }

    /** @test */
    public function test_3_store_the_classroom()
    {
        $credentials = $this->makeTestingClassroomCredentials();
        $response = $this->postJson('api/v1/classrooms/', $credentials);
        $expected = [
            'title',
            'created',
        ];

        $response->assertStatus(200);
        $response->assertJsonStructure($expected);
    }

    /** @test */
    public function test_3_1_store_the_student_with_validation()
    {
        $empty_credentials = [];
        $response = $this->postJson('api/v1/classrooms/', $empty_credentials);
        $response->assertStatus(422);

        $classroom = $this->getRandomClassroom();
        $exist_title_credentials = $this->makeTestingClassroomCredentials($classroom->title);

        $response = $this->postJson('api/v1/classrooms/', $exist_title_credentials);
        $response->assertStatus(422);
        $expected = [
            'errors' => [
                'title'
            ],
        ];
        $response->assertJsonStructure($expected);
    }

    public function getRandomClassroom(): Classroom
    {
        $classroom = Classroom::inRandomOrder()->first();
        if (!$classroom) {
            $classroom = Classroom::factory()->create();
        }
        return $classroom;
    }

    public function makeTestingClassroomCredentials(string $title = null): array
    {
        return [
            'title' => $title ?? $this->faker->sentence(3),
        ];
    }
}
