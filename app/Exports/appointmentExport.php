<?php

namespace App\Exports;

use App\Models\PatientAppointment;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class appointmentExport implements FromView
{
    // protected $patientAppointment;
    protected $request;
    protected $appointments;

    public function __construct(Request $request)
    {
        $this->request = $request;

        $query = PatientAppointment::with(['patient', 'doctor']);

        // Filters (same as your collection code)
        if (auth()->user()->hasRole('Doctor')) {
            $query->where('doctor_id', auth()->id());
        } elseif ($request->doctor_id) {
            $query->where('doctor_id', $request->doctor_id);
        }

        if (auth()->user()->hasRole('Patient')) {
            $query->where('user_id', auth()->id());
        } elseif ($request->user_id) {
            $query->where('user_id', $request->user_id);
        }

        if ($request->appointment_date) {
            $query->whereDate('appointment_date', $request->appointment_date);
        }

        if ($request->start_date && $request->end_date) {
            $query->whereBetween('appointment_date', [$request->start_date, $request->end_date]);
        } elseif ($request->start_date) {
            $query->where('appointment_date', '>=', $request->start_date);
        } elseif ($request->end_date) {
            $query->where('appointment_date', '<=', $request->end_date);
        }

        $this->appointments = $query->get();
    }
    public function view(): View
    {
        return view('exports.appointment', [
            'appointments' => $this->appointments
        ]);
    }
}
