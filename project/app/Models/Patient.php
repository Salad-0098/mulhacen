<?php

namespace App\Models;

use App\Traits\Encryptable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;
    use Encryptable;

    protected $fillable = ['name', 'last_name_1', 'last_name_2', 'document', 'doctor_id', 'identifier'];
    protected $hidden = ['created_at', 'updated_at'];
    public $encryptable = ['name'];

    public function doctor () {
        return $this->belongsTo(Doctor::class);
    }

    public function diagnoses () {
        return $this->hasMany(Diagnosis::class);
    }
}
