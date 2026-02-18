<?php

namespace App\Exports;

use App\Models\Invoice;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class InvoiceExport implements FromView
{
    /**
     * @return \Illuminate\Support\Collection
     */
    protected $invoices;
    public function __construct(Request $request)
    {
        $query = Invoice::with(['user', 'doctor', 'patienttreatmentplan']);

        // ✅ Status filter
        if ($request->has('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        // ✅ Created at date range filter
        if ($request->has('date_from') && $request->has('date_to')) {
            $query->whereBetween('created_at', [$request->date_from, $request->date_to]);
        }

        // ✅ Filter by Patient (auth or request)
        if (auth()->user()->hasRole('Patient')) {
            $query->where('user_id', auth()->id());
        } elseif ($request->user_id) {
            $query->where('user_id', $request->user_id);
        }

        // ✅ Filter by Invoice Number
        if ($request->invoice_number) {
            $query->where('invoice_number', 'like', '%' . $request->invoice_number . '%');
        }

        // ✅ Filter by Invoice Date
        if ($request->invoice_date) {
            $query->where('invoice_date', $request->invoice_date);
        }

        // ✅ Filter by Invoice Date Range
        if ($request->start_date && $request->end_date) {
            $query->whereBetween('invoice_date', [$request->start_date, $request->end_date]);
        } elseif ($request->start_date) {
            $query->where('invoice_date', '>=', $request->start_date);
        } elseif ($request->end_date) {
            $query->where('invoice_date', '<=', $request->end_date);
        }

        // ✅ Filter by Doctor via patient_treatment_plans relationship
        if ($request->doctor_id) {
            $query->whereHas('patienttreatmentplan', function ($q) use ($request) {
                $q->where('doctor_id', $request->doctor_id);
            });
        }

        // ✅ Execute query and save results
        $this->invoices = $query->get();
    }


    public function view(): View
    {
        return view('exports.invoice', [
            'invoices' => $this->invoices
        ]);
    }
}
