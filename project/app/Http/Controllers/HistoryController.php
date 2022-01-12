<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class HistoryController extends Controller
{
    private $allowed_sources = ['patient', 'diagnosis'];

    public function get ($source, $id) {
        if (!in_array($source, $this->allowed_sources)) {
            return response('Source can only be "patient" or "diagnosis"', 400);
        }

        $result = DB::table('histories')
            ->select('old_data', 'modified')
            ->where('source', $source)
            ->where('old_data->id', $id)
            ->get();

        if ($result->isEmpty()) {
            return response('There arent any results for this search', 404);
        }

        foreach ($result as $item) {
            // Abstract the model creation
            $class = '\App\Models\\' . $source;
            $model = new $class(json_decode($item->old_data, true));
            $arr[] = [$model->getAttributes(), $item->modified];
        }

        return $arr;
    }
}
