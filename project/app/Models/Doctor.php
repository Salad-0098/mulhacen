<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    protected $fillable = ['name'];
    protected $hidden = ['api_token', 'created_at', 'updated_at'];

    public function patients () {
        return $this->hasMany(Patient::class);
    }
}
