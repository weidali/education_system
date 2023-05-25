<?php

namespace Tests\Feature;

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
                'title',
                'description',
                'created',
            ],
        ];
        $response->assertStatus(200);
        $response->assertJsonStructure($expected);
    }
}
