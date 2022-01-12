<?php

namespace App\Observers;

use App\Models\Patient;
use App\Models\History;

class PatientObserver
{
    private $source = 'patient';
    /**
     * Handle the Patient "created" event.
     *
     * @param  \App\Models\Patient  $patient
     * @return void
     */
    public function created(Patient $patient)
    {
        //
    }

    /**
     * Handle the Patient "updated" event.
     *
     * @param  \App\Models\Patient  $patient
     * @return void
     */
    public function updated(Patient $patient)
    {
        // we remove the created_at and updated_at keys, since we do not need them
        $old_data = array_diff_key($patient->getOriginal(), array_flip(['created_at', 'updated_at']));
        $data = [
            'source' => $this->source,
            'old_data' => json_encode($old_data),
            'modified' => date("Y-m-d H:i:s")
        ];

        $result = History::create($data);
    }

    /**
     * Handle the Patient "deleted" event.
     *
     * @param  \App\Models\Patient  $patient
     * @return void
     */
    public function deleted(Patient $patient)
    {
        //
    }

    /**
     * Handle the Patient "restored" event.
     *
     * @param  \App\Models\Patient  $patient
     * @return void
     */
    public function restored(Patient $patient)
    {
        //
    }

    /**
     * Handle the Patient "force deleted" event.
     *
     * @param  \App\Models\Patient  $patient
     * @return void
     */
    public function forceDeleted(Patient $patient)
    {
        //
    }
}
