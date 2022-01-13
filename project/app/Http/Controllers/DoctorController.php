<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Str;

class DoctorController extends Controller
{
    public function insert (Request $request) {
        return Doctor::create($request->all());
    }

    public function update (Request $request) {
        $post = $request->all();
        $doctor = Doctor::findOrFail($post['id']);
        return $doctor->update($post);
    }

    public function get ($id) {
        return Doctor::findOrFail($id);
    }

    public function delete ($id) {
        return Doctor::findOrFail($id)->delete();
    }

    public function getPatients ($id) {
        return Doctor::findOrFail($id)->patients;
    }

    public function generateToken ($id) {
        $doctor = Doctor::findOrFail($id);

        if (!$doctor || $doctor->api_token !== null) {
            return response('Token already generated', 403);
        }

        $token = Str::random(80);
        $doctor->api_token = hash('sha256', $token);
        $doctor->save();

        return response(['token' => $token], 200);
    }

}
