<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MotherIntake extends Model
{
    protected $table = 'mother_intakes';

    protected $fillable = [
        'source_id',
        'mk_number',
        'approved_at',
        'approved_by',
        'full_name',
        'phone',
        'journey_stage',
        'pregnancy_weeks',
        'baby_weeks_old',
        'hospital_planned',
        'hospital_alternative',
        'delivery_hospital',
        'birth_hospital',
        'ttc_duration',
        'agree_comms',
        'disclaimer_ack',
        'email',
        'age',
        'pregnancy_stage',
        'due_date',
        'location',
        'previous_pregnancies',
        'concerns',
        'interests',
        'status',
        'reviewed_by',
        'reviewed_at',
        'completed_at',
        'completed_by',
        'notes',
        'progress_comment',
        'priority',
        'user_id',
    ];

    protected $casts = [
        'agree_comms' => 'boolean',
        'disclaimer_ack' => 'boolean',
        'pregnancy_weeks' => 'integer',
        'baby_weeks_old' => 'integer',
        'age' => 'integer',
        'previous_pregnancies' => 'integer',
        'interests' => 'array',
        'due_date' => 'date',
        'approved_at' => 'datetime',
        'reviewed_at' => 'datetime',
        'completed_at' => 'datetime',
    ];
}
