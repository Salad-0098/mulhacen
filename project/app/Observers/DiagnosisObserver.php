<?php

namespace App\Observers;

use App\Models\Diagnosis;
use App\Models\History;

class DiagnosisObserver
{
    private $source = 'diagnosis';
    /**
     * Handle the Diagnosis "created" event.
     *
     * @param  \App\Models\Diagnosis  $diagnosis
     * @return void
     */
    public function created(Diagnosis $diagnosis)
    {
        //
    }

    /**
     * Handle the Diagnosis "updated" event.
     *
     * @param  \App\Models\Diagnosis  $diagnosis
     * @return void
     */
    public function updated(Diagnosis $diagnosis)
    {
        // we remove the created_at and updated_at keys, since we do not need them
        $old_data = array_diff_key($diagnosis->getOriginal(), array_flip(['created_at', 'updated_at']));
        $data = [
            'source' => $this->source,
            'old_data' => json_encode($old_data),
            'modified' => date("Y-m-d H:i:s")
        ];

        $result = History::create($data);
    }

    /**
     * Handle the Diagnosis "deleted" event.
     *
     * @param  \App\Models\Diagnosis  $diagnosis
     * @return void
     */
    public function deleted(Diagnosis $diagnosis)
    {
        //
    }

    /**
     * Handle the Diagnosis "restored" event.
     *
     * @param  \App\Models\Diagnosis  $diagnosis
     * @return void
     */
    public function restored(Diagnosis $diagnosis)
    {
        //
    }

    /**
     * Handle the Diagnosis "force deleted" event.
     *
     * @param  \App\Models\Diagnosis  $diagnosis
     * @return void
     */
    public function forceDeleted(Diagnosis $diagnosis)
    {
        //
    }
}
