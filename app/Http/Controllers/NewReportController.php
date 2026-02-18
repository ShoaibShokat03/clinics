<?php

namespace App\Http\Controllers;

use App\Models\DdProcedure;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\User;
use App\Models\PatientTreatmentPlanProcedure;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\GenericExport;

class NewReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $query = Invoice::with([
        //     'user.patientDetails',
        //     'doctor',
        //     'invoiceItems.patienttreatmentplanprocedures.procedure.ddprocedurecategory'
        // ])->orderBy('created_at', 'desc');

        $query = Invoice::with([
    'user.patientDetails',
    'doctor',
    'invoiceItems.procedure.ddprocedurecategory'  // ← This loads category and procedure
])->orderBy('created_at', 'desc');

     
        // foreach ($invoices as $invoice) {
        //     foreach ($invoice->invoiceItems as $item) {
        //         dd([
        //             'invoice_item_id' => $item->id,
        //             'ptp_id' => $item->patient_treatment_plan_procedure_id,
        //             'exists_in_ptp' => PatientTreatmentPlanProcedure::find($item->patient_treatment_plan_procedure_id) ? true : false
        //         ]);
        //     }
        // }
        // exit;

        if ($request->has('export') && $request->input('export') == 1) {
            return $this->doExport($query);
        }

        // Check if at least one filter is applied
        $filtersApplied = false;

        // Filtering by date_from
        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->input('date_from'));
            $filtersApplied = true;
        }

        // Filtering by date_to
        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->input('date_to'));
            $filtersApplied = true;
        }

        // Filtering by MRN number
        if ($request->filled('mrn_number')) {
            $query->whereHas('user.patientDetails', function ($q) use ($request) {
                $q->where('mrn_number', 'like', '%' . $request->input('mrn_number') . '%');
            });
            $filtersApplied = true;
        }

        // Filtering by invoice_number
        if ($request->filled('invoice_number')) {
            $query->where('invoice_number', 'like', '%' . $request->input('invoice_number') . '%');
            $filtersApplied = true;
        }

        // Filtering by doctor
        if ($request->filled('doctor')) {
            $query->where('doctor_id', $request->doctor);
            $filtersApplied = true;
        }

        // Add patient filter
        if ($request->filled('patient')) {
            $query->where('user_id', $request->patient);
            $filtersApplied = true;
        }

        if ($request->filled('procedure')) {
            $procedureId = $request->input('procedure');
            $query->whereHas('invoiceItems.patienttreatmentplanprocedures', function ($q) use ($procedureId) {
                $q->where('dd_procedure_id', $procedureId);
            });
            $filtersApplied = true;
        }
        $filtersApplied = true;
        // Fetch the filtered data only if filters are applied
        if ($filtersApplied) {
            $invoices = $query->get();
        } else {
            $invoices = collect(); // Return an empty collection if no filters are applied
        }
        // dd(($invoices));
        // exit;
        // Get data for dropdowns
        $doctors = User::role('Doctor')->where('status', '1')->get();
        $patients = User::role('Patient')
            ->where('status', '1')
            ->with('patientDetails')
            ->get();
        $procedures = DdProcedure::all();
        return view('new-reports.index', compact('invoices', 'procedures', 'doctors', 'patients'));
    }


    private function doExport($query)
    {
        // Retrieve all data without pagination
        $invoices = $query->get();

        // Prepare data for export
        $data = [];
        foreach ($invoices as $invoice) {
            foreach ($invoice->invoiceItems as $item) {
                $data[] = [
                    $invoice->user->patientDetails->mrn_number ?? '-',
                    $invoice->user->name ?? '-',
                    $invoice->invoice_number,
                    $invoice->users->name ?? '-',
                    $item->patienttreatmentplanprocedures->procedure->ddprocedurecategory->title ?? '-',
                    $item->patienttreatmentplanprocedures->procedure->title ?? '-',
                    number_format($invoice->grand_total, 2) ?? '-',
                    number_format($invoice->grand_total - $invoice->total_commission, 2) ?? '-',
                    $invoice->commission_percentage . '%',
                    number_format($invoice->total_commission, 2)
                ];
            }
        }

        // Define headers for the export
        $headers = [
            'MRN #',
            'Patient',
            'Invoice #',
            'Doctor',
            'Procedure Category',
            'Procedure',
            'Total Amount',
            'Hospital Amount',
            'Commission %',
            'Total Commission Value'
        ];

        // Use the Maatwebsite Excel package to create and return the export
        return Excel::download(new GenericExport($data, $headers), 'reports.xlsx');
    }
}
