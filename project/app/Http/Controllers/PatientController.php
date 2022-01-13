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
        $patient = Patient::findOrFail($post['id']);
        return $patient->update($post);
    }

    public function getById ($id) {
        //$patient = Patient::findOrFail($id);

        return Patient::findOrFail($id);
    }

    public function getDoctor ($id) {
        return Patient::findOrFail($id)->doctor;
    }

    public function getDiagnoses ($id) {
        return Patient::findOrFail($id)->diagnoses;
    }

    public function delete ($id) {
        return Patient::findOrFail($id)->delete();
    }
}
