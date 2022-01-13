<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Tests\TestCase;

class DiagnosisTest extends TestCase
{
    private $testToken = 'BqglRiJARKWQv7rCOwGcCMrcfyiTbde7ur64UsZWKegZrh2mxPdSZCHJ5I56e3gMendawCN9BHZqrorP';

    public function test_create_vars () {
        $patient = $this
            ->withHeader('Authorization', 'Bearer ' . $this->testToken)
            ->json('post', 'api/patient', [
                'name' => 'test_patient',
                'last_name_1' => 'ln1',
                'last_name_2' => 'ln2',
                'document' => '12345678N',
                'identifier' => strtoupper(Str::random(10)),
                'doctor_id' => 1
            ]);

        $patient->assertStatus(201);
        return json_decode($patient->getContent())->id;
    }

    /**
      * @depends test_create_vars
      */
    public function test_post_create ($patient_id) {
        $response = $this
            ->withHeader('Authorization', 'Bearer ' . $this->testToken)
            ->json('post', 'api/diagnosis', [
                'description' => 'Doesnt write tests',
                'patient_id' => $patient_id
            ]);

        $response->assertStatus(201);
        return json_decode($response->getContent());
    }

    /**
      * @depends test_post_create
      */
    public function test_get_by_id ($diagnosis) {
        $response = $this
            ->withHeader('Authorization', 'Bearer ' . $this->testToken)
            ->json('get', 'api/diagnosis/'.$diagnosis->id);

        $response->assertStatus(200);
    }

    /**
      * @depends test_post_create
      */
    public function test_put_update ($diagnosis) {
        $response = $this
            ->withHeader('Authorization', 'Bearer ' . $this->testToken)
            ->json('post', 'api/diagnosis', [
                'id' => $diagnosis->id,
                'description' => $diagnosis->description,
                'patient_id' => $diagnosis->patient_id
            ]);

        $response->assertStatus(201);
    }

    /**
      * @depends test_post_create
      */
    public function test_delete ($diagnosis) {

        $response = $this
            ->withHeader('Authorization', 'Bearer ' . $this->testToken)
            ->json('delete', 'api/diagnosis/'.$diagnosis->id);

        $response->assertStatus(200);
    }

    /**
      * @depends test_create_vars
      */
    public function test_cleanup ($patient_id) {
        $response = $this
            ->withHeader('Authorization', 'Bearer ' . $this->testToken)
            ->json('delete', 'api/patient/'.$patient_id);

        $response->assertStatus(200);
    }
}
