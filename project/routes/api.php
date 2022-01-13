<?php

use App\Http\Controllers\DiagnosisController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\PatientController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/token/{id}', [DoctorController::class, 'generateToken']);

Route::group(['middleware' => 'quickAuth'], function () {

    Route::post('/doctor', [DoctorController::class, 'insert']);
    Route::get('/doctor/{id}', [DoctorController::class, 'get']);
    Route::get('/doctor/{id}/patients', [DoctorController::class, 'getPatients']);
    Route::put('/doctor', [DoctorController::class, 'update']);
    Route::delete('/doctor/{id}', [DoctorController::class, 'delete']);
    Route::get('/history/{source}/{id}', [HistoryController::class, 'get']);

    Route::post('/patient', [PatientController::class, 'insert']);
    Route::put('/patient', [PatientController::class, 'update']);
    Route::get('/patient/{id}', [PatientController::class, 'getById']);
    Route::get('/patient/{id}/doctor', [PatientController::class, 'getDoctor']);
    Route::get('/patient/{id}/diagnoses', [PatientController::class, 'getDiagnoses']);
    Route::delete('/patient/{id}', [PatientController::class, 'delete']);

    Route::post('/diagnosis', [DiagnosisController::class, 'insert']);
    Route::put('/diagnosis', [DiagnosisController::class, 'update']);
    Route::get('/diagnosis/{id}', [DiagnosisController::class, 'getById']);
    Route::delete('/diagnosis/{id}', [DiagnosisController::class, 'delete']);

});
