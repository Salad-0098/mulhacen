<?php

namespace Database\Seeders;

use App\Models\Doctor;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $doctor = Doctor::where('name', 'Admin')->get();
        if ($doctor->isEmpty()) {
            DB::table('doctors')->insert([
                'name' => 'Admin'
            ]);

            DB::table('patients')->insert([
                'name' => 'admin_test',
                'last_name_1' => 'ln1',
                'last_name_2' => null,
                'document' => '45158565C',
                'identifier' => 'FPN6ESZJVK',
                'doctor_id' => 1
            ]);

            DB::table('diagnoses')->insert([
                'description' => 'PHP programmer',
                'patient_id' => 1
            ]);
        }
    }
}
