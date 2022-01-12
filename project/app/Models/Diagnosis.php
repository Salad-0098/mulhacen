<?php

namespace App\Models;

use App\Traits\Encryptable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diagnosis extends Model
{
    use HasFactory;
    use Encryptable;

    protected $fillable = ['description', 'patient_id'];
    protected $hidden = ['updated_at'];
    public $encryptable = ['description'];

    public function patient () {
        return $this->belongsTo(Patient::class);
    }
}
