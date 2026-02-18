<?php

namespace App\Http\Controllers;

use App\Models\TreatmentPlanNotes;
use Illuminate\Http\Request;

class TreatmentNotesController extends Controller
{
    public function getNotes(Request $request)
    {
        $notes = TreatmentPlanNotes::where('patient_treatment_plan_procedure_id', $request->procedure_id)
            ->where('patient_treatment_plan_id',$request->procedure_plan_id)
            ->select('username', 'datetime')
            ->orderBy('datetime', 'desc')
            ->get();

        return response()->json(['notes' => $notes]);
    }
}
