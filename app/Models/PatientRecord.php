<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class PatientRecord extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded=[];
    protected $fillable = [
        'description_case',
        'consultation_date',
        'reconsultation_date',
        'repose_schedules',
        'operation_date',
        'repose_days',
        'recommendations',
        'patient_state',
        'patient_id',
    ];
    protected $casts = [
        'repose_days' => 'array',
    ];
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

}
