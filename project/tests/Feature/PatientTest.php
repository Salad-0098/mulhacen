<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Tests\TestCase;

class PatientTest extends TestCase
{
    private $testToken = 'BqglRiJARKWQv7rCOwGcCMrcfyiTbde7ur64UsZWKegZrh2mxPdSZCHJ5I56e3gMendawCN9BHZqrorP';

    public function test_create_vars () {
        $doctor = $this
            ->withHeader('Authorization', 'Bearer ' . $this->testToken)
            ->json('post', 'api/doctor', [
                'name' => 'test'
            ]);

        $doctor->assertStatus(201);
        return json_decode($doctor->getContent())->id;
    }

    /**
      * @depends test_create_vars
      */
    public function test_post_create ($doctor_id) {
        $response = $this
            ->withHeader('Authorization', 'Bearer ' . $this->testToken)
            ->json('post', 'api/patient', [
                'name' => 'test_patient',
                'last_name_1' => 'ln1',
                'last_name_2' => 'ln2',
                'document' => '12345678N',
                'identifier' => strtoupper(Str::random(10)),
                'doctor_id' => $doctor_id
            ]);

        $response->assertStatus(201);
        return json_decode($response->getContent());
    }

    /**
      * @depends test_post_create
      */
    public function test_get_by_id ($patient) {
        $response = $this
            ->withHeader('Authorization', 'Bearer ' . $this->testToken)
            ->json('get', 'api/patient/'.$patient->id);

        $response->assertStatus(200);
    }

    /**
      * @depends test_post_create
      */
    public function test_put_update ($patient) {

        $response = $this
            ->withHeader('Authorization', 'Bearer ' . $this->testToken)
            ->json('post', 'api/patient', [
                'id' => $patient->id,
                'name' => $patient->name,
                'last_name_1' => $patient->last_name_1,
                'last_name_2' => $patient->last_name_2,
                'document' => $patient->document,
                'identifier' => $patient->identifier,
                'doctor_id' => $patient->doctor_id
            ]);

        $response->assertStatus(201);
    }

    /**
      * @depends test_post_create
      */
    public function test_delete ($patient) {

        $response = $this
            ->withHeader('Authorization', 'Bearer ' . $this->testToken)
            ->json('delete', 'api/patient/'.$patient->id);

        $response->assertStatus(200);
    }

    /**
      * @depends test_create_vars
      */
    public function test_cleanup ($doctor_id) {
        $response = $this
            ->withHeader('Authorization', 'Bearer ' . $this->testToken)
            ->json('delete', 'api/doctor/'.$doctor_id);

        $response->assertStatus(200);
    }
}
