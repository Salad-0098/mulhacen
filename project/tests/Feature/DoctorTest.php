<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DoctorTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_get_by_id () {
        $response = $this->get('api/doctor/1');

        $response->assertStatus(200);
    }

    public function test_get_by_id2 () {
        $response = $this->get('api/doctor/1');

        $response->assertStatus(200);
    }


}
