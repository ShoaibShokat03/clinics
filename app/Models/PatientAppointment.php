<?php

namespace App\Models;

use App\services\UserLogServices;
use App\Traits\Loggable;
use Illuminate\Database\Eloquent\Model;

class PatientAppointment extends Model
{
    protected $table = 'patient_appointments';
    use Loggable;
    protected $fillable = [
        'user_id',
        'appointment_number',
        'doctor_id',
        'start_time',
        'end_time',
        'appointment_date',
        'problem',
        'appointment_status_id',
        'created_by'
    ];


    public function detail()
    {
        return $this->hasOne(PatientDetail::class);
    }

    public function patient()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function doctor()
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function appointmentstatus()
    {
        return $this->belongsTo(AppointmentStatus::class, 'appointment_status_id');
    }

    public function exam()
    {
        return $this->hasMany(ExamInvestigation::class);
    }
}
