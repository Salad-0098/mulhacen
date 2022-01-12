<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Str;

class PatientController extends Controller
{
    public function insert (Request $request) {
        $request->merge(['identifier' => strtoupper(Str::random(10))]);
        return Patient::create($request->all());
    }

    public function update (Request $request) {
        $post = $request->all();
        $patient = Patient::find($post['id']);
        return $patient->update($post);
    }

    public function getById ($id) {
        //$patient = Patient::find($id);

        return Patient::find($id);
    }

    public function getDoctor ($id) {
        return Patient::find($id)->doctor;
    }

    public function getDiagnoses ($id) {
        return Patient::find($id)->diagnoses;
    }

    public function delete ($id) {
        return Patient::find($id)->delete();
    }
}
