<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DoctorTest extends TestCase
{
    private $testToken = 'BqglRiJARKWQv7rCOwGcCMrcfyiTbde7ur64UsZWKegZrh2mxPdSZCHJ5I56e3gMendawCN9BHZqrorP';

    public function test_post_create () {
        $response = $this
            ->withHeader('Authorization', 'Bearer ' . $this->testToken)
            ->json('post', 'api/doctor', [
                'name' => 'test'
            ]);

        $response->assertStatus(201);
        return json_decode($response->getContent());
    }

    /**
      * @depends test_post_create
      */
    public function test_get_by_id ($doctor) {
        $response = $this
            ->withHeader('Authorization', 'Bearer ' . $this->testToken)
            ->json('get', 'api/doctor/'.$doctor->id);

        $response->assertStatus(200);
    }

    /**
      * @depends test_post_create
      */
    public function test_put_update ($doctor) {
        $response = $this
            ->withHeader('Authorization', 'Bearer ' . $this->testToken)
            ->json('post', 'api/doctor', [
                'id' => $doctor->id,
                'name' => $doctor->name
            ]);

        $response->assertStatus(201);
    }

    /**
      * @depends test_post_create
      */
    public function test_delete ($doctor) {
        $response = $this
            ->withHeader('Authorization', 'Bearer ' . $this->testToken)
            ->json('delete', 'api/doctor/'.$doctor->id);

        $response->assertStatus(200);
    }
}
