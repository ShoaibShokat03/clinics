<?php

namespace App\Http\Controllers;

use App\Models\AccountHeader;
use App\Models\Company;
use App\Models\Insurance;
use App\Models\Invoice;
use App\Models\DoctorDetail;
use App\Models\InvoiceItem;
use App\Models\InvoicePayment;
use App\Models\PatientTreatmentPlan;
use App\Models\DdProcedureCategory;
use App\Models\DdMedicineType;
use App\Models\DeviceToken;
use App\Components\FirebaseComponent;
use App\Models\DdProcedure;
use App\Models\PatientTreatmentPlanProcedure;
use App\Services\NotificationService;
use App\Models\PatientTeeth;
use App\Models\User;
use App\Models\ApplicationSetting;
use App\Models\Setting;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;
use App\Exports\InvoiceExport;
use Maatwebsite\Excel\Facades\Excel;
use function PHPSTORM_META\type;

class AutoInvoiceController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:invoice-read|invoice-create|invoice-update|invoice-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:invoice-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:invoice-update', ['only' => ['edit', 'update']]);
        $this->middleware('permission:invoice-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->export) {
            return $this->doExport($request);
        }
        // if (auth()->user()->hasRole('Patient'))
        //     $patients = User::role('Patient')->where('id', auth()->id())->where('status', '1')->get(['id', 'name']);
        // else
        //     $patients = User::role('Patient')->where('status', '1')->get(['id', 'name']);

        if (auth()->user()->hasRole('Patient')) {
            $patients = User::role('Patient')
                ->where('id', auth()->id())
                ->where('status', '1')
                ->with('patientDetails')
                ->get(['id', 'name']);
        } else {
            $patients = User::role('Patient')
                ->where('status', '1')
                ->with('patientDetails')
                ->get(['id', 'name']);
        }
        // dd($request);
        // exit;
        $doctors = User::role('Doctor')->get();
        $invoices = $this->filter($request)->orderby('id', 'desc')->paginate(10);
        $total = $invoices->sum('total');
        $totalTotalDiscount = $invoices->sum('total_discount');
        $totalGrandTotal = $invoices->sum('grand_total');
        $totalPaid = $invoices->sum('paid');
        $totalDue = $invoices->sum('due');


        return view('invoices.index', compact('invoices', 'patients', 'doctors', 'total', 'totalTotalDiscount', 'totalGrandTotal', 'totalPaid', 'totalDue'));
    }
    private function doExport(Request $request)
    {
        return Excel::download(new InvoiceExport($request), 'Invoices.xlsx');
    }
    public function newTemplate(Request $request, $id)
    {
        try {
            $invoice = Invoice::with(['user.patientDetails', 'users.DoctorDetails', 'invoiceItems', 'invoicePayments'])->where('id', $id)->first();
            // $setting = DB::Table('settings');
            $setting = Setting::pluck('value', 'key')->toArray();
            $applicationSettings = ApplicationSetting::all()->toArray();
            // dd($applicationSettings);
            // exit;
            if (!$invoice) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'no invoice'
                ]);
            }

            $patient = $invoice->user;
            $patientDetail = $patient->patientDetails;
            $doctor = $invoice->users;
            $items = $invoice->invoiceItems;
            $payments = $invoice->invoicePayments;
            return view('invoices.invoiceTemplate', ['patient' => $patient, 'patientDetail' => $patientDetail, 'doctor' => $doctor, 'items' => $items, 'invoice' => $invoice, 'settings' => $setting, 'payments' => $payments, 'applicationSettings' => $applicationSettings]);
        } catch (Exception $e) {
            return response()->json(['status' => 'error', $e->getMessage()], 404);
        }
    }
    /**
     * Filter function
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    private function filter(Request $request)
    {
        $query = Invoice::where('company_id', session('company_id'));

        if (auth()->user()->hasRole('Patient')) {
            $query->where('user_id', auth()->id());
        } elseif ($request->user_id) {
            $query->where('user_id', $request->user_id);
        }

        if ($request->invoice_number) {
            $query->where('invoice_number', 'like', '%' . $request->invoice_number . '%');
        }
        if ($request->invoice_date) {
            $query->where('invoice_date', $request->invoice_date);
        }

        if ($request->start_date && $request->end_date) {
            $query->whereBetween('invoice_date', [$request->start_date, $request->end_date]);
        } elseif ($request->start_date) {
            $query->where('invoice_date', '>=', $request->start_date);
        }
        if ($request->doctor_id) {
            $query->where('doctor_id', $request->doctor_id);
        }
        if ($request->paid === 'partial') {
            $query->where('due', '>', 0);
        }

        if ($request->paid === 'complete') {
            $query->where('due', '=', 0);
        }
        // Join the patient_treatment_plans table to filter by doctor
        // if ($request->doctor_id) {
        //     $query->whereHas('patienttreatmentplan', function ($q) use ($request) {
        //         $q->where('doctor_id', $request->doctor_id);
        //     });
        // }

        return $query;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        if ($request->treatment_plan_id) {
            $patientTreatmentPlan = PatientTreatmentPlan::find($request->treatment_plan_id);
            $doctors = User::role('Doctor')->where('id', $patientTreatmentPlan->doctor_id)->get(['id', 'name']);
            $patients = User::where('id', $patientTreatmentPlan->patient_id)->get(['id', 'name']);
            // $medicineTypes = DdMedicineType::get(['id', 'name']);
            $percentage = DoctorDetail::where('user_id', $patientTreatmentPlan->doctor_id)->pluck('commission')->first();
            $teeth = PatientTeeth::with('toothIssues')->where('examination_id', $patientTreatmentPlan->examination_id)->get();
            $patientTreatmentPlanProcedures = PatientTreatmentPlanProcedure::where('patient_treatment_plan_id', $patientTreatmentPlan->id)
                ->where(function ($query) use ($teeth) {
                    $query->whereIn('tooth_number', $teeth->pluck('tooth_number')->toArray())
                        ->orWhereNull('tooth_number');
                })
                ->where('ready_to_start', 'yes')
                ->where('is_procedure_started', 'yes')
                ->where('is_procedure_finished', 'yes')
                ->whereDoesntHave('invoiceItems') // Ensure procedures not already invoiced
                ->get();
            $insurances = Insurance::where('status', '1')->get();
            $accountHeader = AccountHeader::where('type', 'Debit')->where('status', '1')->first();
            $medicineTypes = DdMedicineType::all();
            $procedureCategories = DdProcedureCategory::get(['id', 'title']);

            //var_dump(($patientTreatmentPlanProcedures));exit;
            if($patientTreatmentPlanProcedures->count() > 0){
            
                return view('invoices.autocreate', compact('patients', 'patientTreatmentPlan', 'insurances', 'accountHeader', 'patientTreatmentPlanProcedures', 'teeth', 'doctors', 'percentage', 'medicineTypes', 'procedureCategories'));
            }else{
                return redirect()->route('invoices.index')->with('error', 'Invoice already created or No completed procedures available for invoicing.');
            
            }
        }

        $procedureCategories = DdProcedureCategory::get(['id', 'title']);
        $medicineTypes = DdMedicineType::get(['id', 'name']);
        $procedures = DdProcedure::all();
        $accountHeader = AccountHeader::where('type', 'Debit')->where('status', '1')->first();
        $insurances = Insurance::where('status', '1')->get();
        $patients = User::role('Patient')->where('company_id', session('company_id'))->where('status', '1')->orderBy('created_at', 'desc')->get(['id', 'name']);
        $doctors = User::role('Doctor')->orderBy('created_at', 'desc')->get(['id', 'name']);
        return view('invoices.autocreate', compact('accountHeader', 'insurances', 'patients', 'doctors', 'procedureCategories', 'procedures', 'medicineTypes'));
    }

    public function fetchCommission(Request $request)
    {
        $doctorId = $request->input('doctor_id');
        $doctor = DoctorDetail::where('user_id', $doctorId)->first();


        if ($doctor) {
            return response()->json([
                'success' => true,
                // 'doctor'=>$doctor,
                'commission_percentage' => $doctor->commission, // Adjust according to your model
            ]);
        } else {
            return response()->json([
                'success' => false,
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validation($request);
        foreach ($request->patient_treatment_plan_procedure_id as $key => $value) {
            if (empty($request->procedure_id[$key])) {
                return redirect()->route('invoices.create')
                    ->with('error', 'Add at least one category product.');
            }
        }
        $invoice = null;
        DB::transaction(function () use ($request, &$invoice) {
            $invoice = Invoice::create([
                'company_id' => session('company_id'),
                'user_id' => $request->user_id,
                'insurance_id' => $request->insurance_id,
                'doctor_id' => $request->doctor_id,
                'discount_percentage' => $request->discount_percentage,
                'discount' => $request->discount,
                'commission_percentage' => $request->commission_percentage,
                'patient_treatment_plan_id' => $request->patient_treatment_plan_id,
                'invoice_date' => Carbon::parse($request->invoice_date),
                'created_by' => auth()->id()
            ]);

            $invoice['invoice_number'] = getDocNumber($invoice->id, 'INV');
            $invoice->save();
            // $url = 'patient-appointments.show';
            // $msg = "New Appointment has been Created For You";
            // $msgforadmin = "New Appointment has been Created for " . $invoice->doctor->name;
            // $token = DeviceToken::where('user_id', $invoice->user_id)->first();
            // $doctor_token = DeviceToken::where('user_id', $invoice->doctor_id)->first();
            // $FB = new FirebaseComponent();
            // $FB->sendToDevice($token->device_token, "Appointment done", "Your appointment is done with the doctor {$appointment->docotr->name}", []);
            // if ($doctor_token) {
            //     $FB->sendToDevice(
            //         $doctor_token->device_token,
            //         "New Appointment",
            //         "You have a new appointment with patient {$invoice->user->name}",
            //         []
            //     );
            // }

            $this->storeInvoice($request, $invoice);
        });

        return redirect()->route('invoices.index', $invoice)->with('success', trans('Invoice Added Successfully'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function show(Invoice $invoice)
    {
        if (auth()->user()->hasRole('Patient') && auth()->id() != $invoice->user_id)
            return redirect()->route('dashboard');

        // Try to get company from invoice, fallback to session company_id
        $companyId = $invoice->company_id ?? session('company_id');

        if (!$companyId) {
            return redirect()->route('invoices.index')->with('error', trans('Company not found for this invoice'));
        }

        $company = Company::find($companyId);

        if (!$company) {
            return redirect()->route('invoices.index')->with('error', trans('Company not found'));
        }

        $company->setSettings();

        return view('invoices.show', compact('company', 'invoice'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function edit(Invoice $invoice)
    {
        $doctors = User::role('Doctor')->where('id', $invoice->doctor_id)->get(['id', 'name']);
        $patients = User::role('Patient')->where('id', $invoice->user_id)->get(['id', 'name']);
        $accountHeader = AccountHeader::where('type', 'Debit')->where('status', '1')->first();
        $insurances = Insurance::where('status', '1')->get();
        $invoicePayments = InvoicePayment::where('invoice_id', $invoice->id)->get();
        // $invoiceItem = InvoiceItem::where('invoice_id', $invoice->id);
        $totalPaidAmount = $invoicePayments->sum('paid_amount');
        $grandTotal = $invoice->grand_total;
        $procedureCategories = DdProcedureCategory::get(['id', 'title']);
        // dd($invoice->user->patientDetails->insurance_verified);
        return view('invoices.edit', compact('accountHeader', 'insurances', 'invoice', 'patients', 'invoicePayments', 'totalPaidAmount', 'grandTotal', 'doctors', 'procedureCategories'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Invoice $invoice)
    {

        // $invoiceDate = $request->post('invoice_date');


        $this->validation($request);
        $invoice->invoiceItems()->delete();
        $invoice->updated_by = auth()->id();
        //$invoice->payment_date = $request->post('payment_date');
        $this->storeInvoice($request, $invoice);
        $invoice->save();

        return redirect()->route('invoices.index')->with('success', trans('Invoice Updated Successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $invoice = Invoice::where('id', $id)->first();
        // if ($invoice->invoiceItems()->exists())
        //     return redirect()->route('invoices.index')->with('error', trans('Invoice Cannot be deleted'));

        // $invoice->invoiceItems()->delete();
        // $invoice->delete();
        if ($invoice->invoiceItems()->exists()) {

            $invoice->invoiceItems()->delete();
        }

        // Delete invoice
        $invoice->delete();

        return redirect()->route('invoices.index')->with('success', trans('Invoice Removed Successfully'));
    }

    /**
     * Stores invoce data
     *
     * @param Request $request
     * @param Invoice $invoice
     * @return void
     */
    // private function storeInvoice(Request $request, Invoice $invoice)
    // {
    //     try {


    //         DB::transaction(function () use ($request, $invoice) {

    //             $invoiceItems = [];
    //             $total = 0;
    //             $disTotal = 0;
    //             $total_discount = 0;
    //             $discount_amountTotal = 0;
    //             $grandTotal = 0;
    //             $totalCommission = 0;
    //             $doctorCommission = 0;
    //             foreach ($request->patient_treatment_plan_procedure_id as $key => $value) {

    //                 // $itemTotal = round(($request->quantity[$key] * $request->price[$key]), 2);
    //                 $quantity = round($request->quantity[$key], 2);
    //                 // $price = round($request->price[$key], 2);
    //                 $price = round((float) $request->price[$key], 2);

    //                 // $item_discount = round(intval($request->item_discount[$key]) ?? 0, 2);

    //                 // $discountAmount = round($request->item_total_discount[$key] ?? 0, 2);
    //                 $value = preg_replace('/[^0-9.\-]/', '', $request->item_total_discount[$key] ?? 0);
    //                 $discountAmount = round((float) $value, 2);

    //                 $allTotal = round(($quantity * $price));
    //                 // Total per item = (quantity * price) - discount_amount
    //                 $itemTotal = round((float) $request->quantity[$key], 2) * round((float) $request->price[$key], 2);

    //                 // $itemTotal = round($request->quantity[$key], 2) * round($request->price[$key], 2);
    //                 // $total_discount += $item_discount;
    //                 $modelProcedure = null;
    //                 // if (!empty($request->procedure_id[$key])) {
    //                 //     $modelProcedure = DdProcedure::find($request->procedure_id[$key]);
    //                 // }
    //                 if (empty($request->procedure_id[$key])) {
    //                     throw new \Exception('Add at least one category product.');
    //                 } else {
    //                     $modelProcedure = DdProcedure::find($request->procedure_id[$key]);
    //                 }
    //                 $invoiceItems[] = [
    //                     'company_id' => session('company_id'),
    //                     'invoice_id' => $invoice->id,
    //                     'patient_treatment_plan_procedure_id' => empty($request->patient_treatment_plan_procedure_id[$key]) ? null : $request->patient_treatment_plan_procedure_id[$key],
    //                     'title' => ($modelProcedure && $modelProcedure->procedure_code) ? $modelProcedure->procedure_code : $request->title[$key],
    //                     'account_name' => $request->account_name[$key],
    //                     'description' => $request->description[$key],
    //                     'procedure_id' => empty($request->procedure_id[$key]) ? null : $request->procedure_id[$key],
    //                     'procedure_category_id' => empty($request->procedure_category_id[$key]) ? null : $request->procedure_category_id[$key],
    //                     'account_type' => 'Debit',
    //                     'quantity' => round($request->quantity[$key], 2),
    //                     'price' => round((float) $request->price[$key], 2),
    //                     //new
    //                     // 'discount_percentage' => intval(round($request->discount_percentage[$key] ?? 0, 1)),
    //                     // 'discount_percentage' => floatval($item_discount ?? 0),
    //                     // 'discount_amount' => $discountAmount,
    //                     //new above
    //                     // 'due'=> $itemTotal,
    //                     'total' => $itemTotal,
    //                     'created_at' => now(),
    //                     'updated_at' => now(),
    //                     'created_by' => auth()->id()
    //                 ];
    //                 $total += $allTotal;
    //                 $disTotal += $itemTotal;
    //                 $discount_amountTotal += $discountAmount;
    //             }
    //             InvoiceItem::insert($invoiceItems);
    //             // dd('call here 2');
    //             // exit;
    //             $totalCommission = round($request->total_commission, 2);
    //             // Calculate the commission based on the percentage
    //             if ($request->commission_percentage > 0) {
    //                 $doctorCommission = ($request->commission_percentage / 100) * $grandTotal;
    //             } else {
    //                 $doctorCommission = $totalCommission;
    //             }

    //             // Round the final commission amount
    //             $doctorCommission = round($doctorCommission, 2);
    //             $grandTotal = round($total - $discount_amountTotal, 2);
    //             // End of commission calculation
    //             $invoice->update([
    //                 'insurance_id' => $request->insurance_id,
    //                 'invoice_date' => $request->invoice_date,
    //                 // 'vat_percentage' => $request->vat_percentage,
    //                 // 'total_vat' => $totalVat,
    //                 'total' => $total,
    //                 // 'discount_percentage' => $request->discount_percentage,
    //                 'total_commission' => $doctorCommission,
    //                 'total_discount' => $discount_amountTotal,
    //                 'grand_total' => $grandTotal,
    //                 'paid' => $request->paid,
    //                 'due' => $grandTotal - $request->paid
    //             ]);
    //         });
    //     } catch (\Exception $e) {
    //         DB::rollBack();
    //         return redirect()->route('invoices.create')->with('error', $e->getMessage());
    //     }
    // }

    private function storeInvoice(Request $request, Invoice $invoice)
    {
        try {
            DB::transaction(function () use ($request, $invoice) {
                $invoiceItems = [];
                $total = 0; // Total before discount

                // Loop through items to build invoice items and calculate raw total
              foreach ($request->quantity as $key => $qty) {
    $quantity = round((float)$qty, 2);
    $price    = round((float)$request->price[$key], 2);
    $itemTotal = $quantity * $price;
    $total += $itemTotal;

    if (empty($request->procedure_id[$key])) {
        throw new \Exception('Please select a procedure for all items.');
    }

    $modelProcedure = DdProcedure::find($request->procedure_id[$key]);

    $invoiceItems[] = [
        'company_id' => session('company_id'),
        'invoice_id' => $invoice->id,
        'patient_treatment_plan_procedure_id' => !empty($request->patient_treatment_plan_procedure_id[$key]) 
            ? (int)$request->patient_treatment_plan_procedure_id[$key] 
            : null,  // ← FIX: Use NULL if empty
        'title' => $modelProcedure->procedure_code ?? $request->title[$key] ?? 'Procedure',
        'account_name' => $request->account_name[$key] ?? '',
        'description' => $request->description[$key] ?? null,
        'procedure_id' => $request->procedure_id[$key],
        'procedure_category_id' => $request->procedure_category_id[$key] ?? null,
        'account_type' => 'Debit',
        'quantity' => $quantity,
        'price' => $price,
        'total' => $itemTotal,
        'created_at' => now(),
        'updated_at' => now(),
        'created_by' => auth()->id()
    ];
}

                // Insert all items
                InvoiceItem::insert($invoiceItems);

                // === GLOBAL DISCOUNT (after total is fully calculated) ===
                $discountPercentage = (float)($request->discount_percentage ?? 0);
                $discountAmount     = round(($total * $discountPercentage) / 100, 2);
                $grandTotal         = round($total - $discountAmount, 2);

                // === COMMISSION ===
                $doctorCommission = 0;
                if ($request->filled('commission_percentage') && $request->commission_percentage > 0) {
                    $doctorCommission = round(($request->commission_percentage / 100) * $grandTotal, 2);
                } else {
                    $doctorCommission = round($request->total_commission ?? 0, 2);
                }

                // === FINAL INVOICE UPDATE ===
                $invoice->update([
                    'insurance_id'       => $request->insurance_id,
                    'invoice_date'       => $request->invoice_date,
                    'total'              => $total,
                    'total_discount'     => $discountAmount,
                    'grand_total'        => $grandTotal,
                    'total_commission'   => $doctorCommission,
                    'paid'               => $request->paid ?? 0,
                    'due'                => $grandTotal - ($request->paid ?? 0),
                ]);
            });

            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e; // or return redirect with error
        }
    }


    /**
     * Validation function
     *
     * @param Request $request
     * @return void
     */
    private function validation(Request $request)
    {
        $request->validate([
            'user_id' => ['required', 'integer', 'exists:users,id'],
            'insurance_id' => ['nullable', 'integer', 'exists:insurances,id'],
            'invoice_date' => ['required', 'date'],
            // 'vat_percentage' => ['required', 'numeric'],
            // 'total_vat' => ['required', 'numeric'],
            // 'discount_percentage' => ['required'],
            'discount_percentage'   => ['numeric'],
            'discount_percentage.*' => ['nullable', 'numeric'],

            // 'discount' => ['required'],
            'total_discount' => ['numeric'],
            'paid' => ['required', 'numeric'],
            'title' => ['required', 'array'],
            'description' => ['required', 'array'],
            'quantity' => ['required', 'array'],
            'price' => ['required', 'array'],
            'total' => ['required', 'numeric']
        ]);
    }
}
