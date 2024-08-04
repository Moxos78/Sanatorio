<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Patient extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded=[];
    public function patient_record():HasMany
    {
        return $this->hasMany(PatientRecord::class);
    }

    public function latestPatientRecord()
    {
        return $this->hasOne(PatientRecord::class)->latestOfMany();
    }
    /*public function latestPatientRecord(): HasOne
    {
        return $this->hasOne(PatientRecord::class)->latest('consultation_date');
    }*/
    protected $fillable = [
        'code',
        'name',
        'lastname',
        'address',
        'cellphone',
        'repose_days',
        'birthday',
        'residence',
        'notify',
    ];

}
