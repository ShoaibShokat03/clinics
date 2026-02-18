<?php

namespace App\Http\Controllers;

use App\Exports\PaymentExport;
use App\Models\AccountHeader;
use App\Models\Payment;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\UserLogs;

class PaymentController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:payment-read|payment-create|payment-update|payment-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:payment-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:payment-update', ['only' => ['edit', 'update']]);
        $this->middleware('permission:payment-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->export == 1) {
            return $this->doExport($request);
        }

        $query = $this->applyFilters($request);

        $payments     = $query->orderBy('id', 'desc')->paginate(10)->withQueryString();
        $accountHeaders = AccountHeader::where('status', '1')->get();

        // Calculate total of filtered records (important!)
        $totalAmount = $query->sum('amount');

        return view('payments.index', compact(
            'payments',
            'accountHeaders',
            'totalAmount'
        ));
    }

    /**
     * Apply all filters to the query
     */
    private function applyFilters(Request $request)
    {
        $query = Payment::query();

        // Account name (exact match)
        if ($request->filled('account_name')) {
            $query->where('account_name', $request->account_name);
        }

        // Receiver name (partial match both sides)
        if ($request->filled('receiver_name')) {
            $query->where('receiver_name', 'like', '%' . trim($request->receiver_name) . '%');
        }

        // Date range filter (recommended way)
        if ($request->filled('start_date')) {
            $query->whereDate('payment_date', '>=', $request->start_date);
        }

        if ($request->filled('end_date')) {
            $query->whereDate('payment_date', '<=', $request->end_date);
        }

        // Optional: if you want default to current month when no dates selected
        // if (!$request->filled('start_date') && !$request->filled('end_date')) {
        //     $query->whereMonth('payment_date', now()->month)
        //           ->whereYear('payment_date', now()->year);
        // }

        return $query;
    }

    /**
     * Export filtered data
     */
    private function doExport(Request $request)
    {
        $query = $this->applyFilters($request);
        return Excel::download(new PaymentExport($query), 'Expenses-' . now()->format('Y-m-d') . '.xlsx');
    }

    public function create()
    {
        $accountHeaders = AccountHeader::where('type', 'Credit')->where('status', '1')->get();
        return view('payments.create', compact('accountHeaders'));
    }

    public function store(Request $request)
    {
        $this->validation($request);

        $data = $request->only([
            'payment_date',
            'receiver_name',
            'description',
            'amount',
            'paid_by',
            'material_name',
            'payment_method'
        ]);

        $accountHeader = AccountHeader::findOrFail($request->account_name);

        $data['account_name']  = $accountHeader->name;
        $data['account_type']  = $accountHeader->type;
        $data['company_id']    = session('company_id');
        $data['created_by']    = auth()->id();

        $payment = Payment::create($data);

        return redirect()->route('payments.edit', $payment->id)
            ->with('success', 'Payment Added Successfully');
    }

    public function show(Payment $payment)
    {
        return view('payments.show', compact('payment'));
    }

    public function edit(Payment $payment)
    {
        $accountHeaders = AccountHeader::where('type', 'Credit')->where('status', '1')->get();
        return view('payments.edit', compact('accountHeaders', 'payment'));
    }

    public function update(Request $request, Payment $payment)
    {
        $this->validation($request);

        $data = $request->only([
            'payment_date',
            'receiver_name',
            'description',
            'amount',
            'paid_by',
            'material_name',
            'payment_method'
        ]);

        $accountHeader = AccountHeader::findOrFail($request->account_name);

        $data['account_name'] = $accountHeader->name;
        $data['account_type'] = $accountHeader->type;
        $data['updated_by']   = auth()->id();

        $payment->update($data);

        return redirect()->route('payments.index')
            ->with('success', 'Payment Updated Successfully');
    }

    public function destroy(Payment $payment)
    {
        $payment->delete();
        return redirect()->route('payments.index')
            ->with('success', 'Payment Deleted Successfully');
    }

    private function validation(Request $request)
    {
        $request->validate([
            'account_name'   => ['required', 'integer', 'exists:account_headers,id'],
            'payment_date'   => ['required', 'date'],
            'receiver_name'  => ['required', 'string', 'max:255'],
            'description'    => ['nullable', 'string', 'max:1000'],
            'amount'         => ['required', 'numeric', 'min:0'],
            'paid_by'        => ['nullable', 'string', 'max:100'],
            'material_name'  => ['nullable', 'string', 'max:255'],
            'payment_method' => ['nullable', 'string', 'max:100'],
        ]);
    }
}
