<?php

namespace App\Http\Controllers;

use App\Models\Diagnosis;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class DiagnosisController extends Controller
{
    public function insert (Request $request) {
        return Diagnosis::create($request->all());
    }

    public function update (Request $request) {
        $post = $request->all();
        $diagnosis = Diagnosis::findOrFail($post['id']);
        return $diagnosis->update($post);
    }

    public function getById ($id) {
        return Diagnosis::findOrFail($id);
    }

    public function getAll (Request $request) {

    }

    public function delete ($id) {
        return Diagnosis::findOrFail($id)->delete();
    }
}
