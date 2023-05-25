<?php

namespace Tests\Feature;

use App\Models\Lecture;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LectureControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    /** @test */
    public function test_1_get_list_of_all_lectures()
    {
        $response = $this->getJson('api/v1/lectures');
        $expected = [
            '*' => [
                'theme',
                'description',
                'created',
            ],
        ];
        $response->assertStatus(200);
        $response->assertJsonStructure($expected);
    }

    /** @test */
    public function test_2_get_the_lecture()
    {
        $lecture = $this->getRandomLecture();
        $response = $this->getJson('api/v1/lectures/' . $lecture->id);
        $expected = [
            'theme',
            'description',
            'created',
        ];

        $response->assertStatus(200);
        $response->assertJsonStructure($expected);
    }

    /** @test */
    public function test_3_store_the_lecture()
    {
        $credentials = $this->makeTestingLectureCredentials();
        $response = $this->postJson('api/v1/lectures/', $credentials);
        $expected = [
            'theme',
            'description',
            'created',
        ];

        $response->assertStatus(200);
        $response->assertJsonStructure($expected);
    }

    /** @test */
    public function test_3_1_can_not_store_the_lecture_case_validation()
    {
        $empty_credentials = [];
        $response = $this->postJson('api/v1/lectures/', $empty_credentials);
        $response->assertStatus(422);

        $classroom = $this->getRandomLecture();
        $exist_theme_credentials = $this->makeTestingLectureCredentials($classroom->theme);

        $response = $this->postJson('api/v1/lectures/', $exist_theme_credentials);
        $response->assertStatus(422);
        $expected = [
            'errors' => [
                'theme'
            ],
        ];
        $response->assertJsonStructure($expected);
    }

    public function getRandomLecture(): Lecture
    {
        $lecture = Lecture::inRandomOrder()->first();
        if (!$lecture) {
            $lecture = Lecture::factory()->create();
        }
        return $lecture;
    }

    public function makeTestingLectureCredentials(string $theme = null): array
    {
        return [
            'theme' => $theme ?? $this->faker->sentence(3),
            'description' => $this->faker->sentence(5),
        ];
    }
}
