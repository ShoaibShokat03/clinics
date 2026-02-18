<?php

namespace App\Http\Controllers;

use App\Models\DdFinding;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DdFindingController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:dropdown-read|dropdown-create|dropdown-update|dropdown-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:dropdown-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:dropdown-update', ['only' => ['edit', 'update']]);
        $this->middleware('permission:dropdown-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $ddFindings = DdFinding::query();

        if ($request->has('name') && !empty($request->name)) {
            $ddFindings->where('name', 'like', '%' . $request->name . '%');
        }

        $ddFindings = $ddFindings->orderBy('id', 'desc')->paginate(10);

        return view('dd_findings.index', compact('ddFindings'));
    }

    public function create()
    {
        return view('dd_findings.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'status' => 'required'
        ]);

        $data = $request->all();
        $data['created_by'] = auth()->user()->id;
        DdFinding::create($data);

        return redirect()->route('dd-findings.index')
            ->with('success', 'Finding created successfully.');
    }

    public function edit($id)
    {
        $ddFinding = DdFinding::findOrFail($id);
        return view('dd_findings.edit', compact('ddFinding'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'status' => 'required'
        ]);

        $ddFinding = DdFinding::findOrFail($id);
        $data = $request->all();
        $data['updated_by'] = auth()->user()->id;
        $ddFinding->update($data);

        return redirect()->route('dd-findings.index')
            ->with('success', 'Finding updated successfully');
    }

    public function destroy($id)
    {
        $ddFinding = DdFinding::findOrFail($id);
        $ddFinding->delete();
        return redirect()->route('dd-findings.index')
            ->with('success', 'Finding deleted successfully.');
    }
}
