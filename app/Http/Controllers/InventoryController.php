<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Category;
use App\Models\UserLogs;
use App\Traits\Loggable;
use App\Models\Inventory;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Exports\GenericExport;
use App\Models\InventoryConsumed;
use App\Models\InventoryAddition;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;

class InventoryController extends Controller
{
    use loggable;
    public function __construct()
    {
        $this->middleware('permission:inventory-read|inventory-create|inventory-update|inventory-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:inventory-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:inventory-update', ['only' => ['edit', 'update']]);
        $this->middleware('permission:inventory-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Apply the filter to the query
        $query = $this->filter($request);

        // Check if the request is for export
        if ($request->has('export') && $request->input('export') == 1) {
            return $this->doExport($query);
        }

        // $inventories = $query->select(
        //     'inventories.*',
        //     DB::raw('COALESCE(SUM(inventory_consumeds.quantity), 0) as consumed_quantity')
        // )
        // ->join('dd_categories', 'inventories.category_id', '=', 'dd_categories.id')
        // ->join('dd_subcategories', 'inventories.subcategory_id', '=', 'dd_subcategories.id')
        // ->leftJoin('inventory_consumeds', 'inventories.id', '=', 'inventory_consumeds.inventory_id')
        // ->groupBy(
        //     'inventories.id',
        //     'inventories.item_id',
        //     'inventories.category_id',
        //     'inventories.subcategory_id',
        //     'inventories.quantity',
        //     'inventories.unitprice',
        //     'inventories.created_at',
        //     'inventories.updated_at',
        //     'inventories.created_by',
        //     'inventories.updated_by'
        // )
        // ->orderBy('inventories.category_id')
        // ->orderBy('inventories.subcategory_id')
        // ->paginate(300);
        $inventories = $query->select(
            'inventories.*',
            DB::raw('COALESCE(SUM(inventory_consumeds.quantity), 0) as consumed_quantity')
        )
            ->join('dd_categories', 'inventories.category_id', '=', 'dd_categories.id')
            ->join('dd_subcategories', 'inventories.subcategory_id', '=', 'dd_subcategories.id')
            ->leftJoin('inventory_consumeds', 'inventories.id', '=', 'inventory_consumeds.inventory_id')
            ->groupBy(
                'inventories.id',
                'inventories.item_id',
                'inventories.category_id',
                'inventories.subcategory_id',
                'inventories.quantity',
                'inventories.unitprice',
                'inventories.created_at',
                'inventories.updated_at',
                'inventories.created_by',
                'inventories.updated_by'
            )
            ->orderBy('updated_at', 'desc') // 👈 latest first
            ->paginate(10);

        // Fetch all items, categories, and subcategories for the filter dropdown
        $items = Item::orderBy('id', 'desc')->get();
        $categories = Category::orderBy('id', 'desc')->get();
        $subcategories = SubCategory::orderBy('id', 'desc')->get();

        // Return the view with paginated results, items, categories, and subcategories
        return view('inventory.index', compact('inventories', 'items', 'categories', 'subcategories'));
    }

    private function filter(Request $request)
    {
        $query = Inventory::query();

        // if ($request->has('item_id') && !empty($request->input('item_id'))) {
        //     $query->whereHas('item', function ($subquery) use ($request) {
        //         $subquery->where('title', 'like', '%' . $request->input('item_id') . '%');
        //     });
        // }

        if ($request->has('item_id') && !empty($request->input('item_id'))) {
            $query->where('item_id', $request->input('item_id'));
        }

        if ($request->has('category_id') && !empty($request->input('category_id'))) {
            $query->where('inventories.category_id', $request->input('category_id'));
        }

        if ($request->has('subcategory_id') && !empty($request->input('subcategory_id'))) {
            $query->where('inventories.subcategory_id', $request->input('subcategory_id'));
        }

        if ($request->has('start_date') && !empty($request->input('start_date')) && $request->has('end_date') && !empty($request->input('end_date'))) {
            $startDate = $request->input('start_date') . ' 00:00:00';
            $endDate = $request->input('end_date') . ' 23:59:59';
            $query->whereBetween('inventories.created_at', [$startDate, $endDate]);
        }

        return $query->orderBy('updated_at', 'desc');
    }

    public function consumedQuantity(Request $request)
    {
        $inventory = Inventory::find($request->inventory_id);

        if (!$inventory) {
            return back()->with('error', 'Inventory not found.');
        }

        if ($request->quantity > $inventory->quantity) {
            return back()->with('error', 'Consumed quantity cannot exceed available quantity.');
        }

        // $inventory->quantity -= $request->quantity;
        // $inventory->save();
        // Update available quantity
        $inventory->save();
        $consumed = new InventoryConsumed();
        $consumed->username = Auth::user()->name;
        $consumed->quantity = $request->quantity;
        $consumed->inventory_id = $request->inventory_id;
        $consumed->save();

        return back()->with('success', 'Inventory consumed successfully.');
    }


    private function doExport($query)
    {
        // Retrieve all data without pagination
        $inventories = $query->get();

        // Prepare data for export
        $data = $inventories->map(function ($inventory) {
            // Ensure consumed_quantity is calculated correctly
            $consumedQuantity = InventoryConsumed::where('inventory_id', $inventory->id)->sum('quantity');

            return [
                $inventory->id,
                $inventory->item->title ?? 'N/A',
                $inventory->category->title ?? 'N/A',
                $inventory->subcategory->title ?? 'N/A',
                $inventory->unitprice,
                $inventory->quantity,
                $consumedQuantity, // Use the calculated consumed quantity
                max(0, $inventory->quantity - $consumedQuantity), // Calculate available quantity
                $inventory->created_at,
                $inventory->updated_at,
            ];
        })->toArray();

        // Define headers for the export
        $headers = ['ID', 'Item Name', 'Category Name', 'Subcategory Name', 'Unit Price', 'Quantity', 'Consumed Quantity', 'Available Quantity', 'Created At', 'Updated At'];

        // Use the Maatwebsite Excel package to create and return the export
        return Excel::download(new GenericExport($data, $headers), 'inventories.xlsx');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $items = Item::all();
        $categories = Category::all();
        $subCategories = SubCategory::all();

        return view('inventory.create', compact('items', 'categories', 'subCategories'));
    }
    public function getSubCategories($categoryId)
    {
        $subCategories = SubCategory::where('category_id', $categoryId)->get();
        return response()->json($subCategories);
    }

    public function getItems($categoryId)
    {
        $items = Item::where('category_id', $categoryId)->get();
        return response()->json($items);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'item_id' => 'required|exists:items,id',
            'category_id' => 'required|exists:dd_categories,id',
            'subcategory_id' => 'nullable|exists:dd_subcategories,id',
            'quantity' => 'required|integer',
            'unitprice' => 'required|numeric',
        ]);
        $validatedData['created_by'] = auth()->id();
        $inventory = Inventory::where('item_id', $validatedData['item_id'])
            ->where('category_id', $validatedData['category_id'])
            ->where('subcategory_id', $validatedData['subcategory_id'])
            ->first();

        if ($inventory) {
            $inventory->quantity += $validatedData['quantity'];
            $inventory->unitprice = $validatedData['unitprice']; // Update unit price if necessary
            $inventory->updated_by = auth()->id(); // Update the user who modified the record
            $inventory->save();
        } else {
            // Create a new inventory item
            $inventory = Inventory::create($validatedData);
        }

        $inventoryAddition = new InventoryAddition();
        $inventoryAddition->created_by = Auth::user()->id;
        $inventoryAddition->unitprice = $validatedData['unitprice'];
        $inventoryAddition->quantity = $validatedData['quantity'];
        $inventoryAddition->inventory_id = $inventory->id;
        $inventoryAddition->save();

        return redirect()->route('inventories.index')->with('success', 'Inventory addedd successfully');
    }

    public function consume(Request $request)
    {
        // Validate the request
        $request->validate([
            'inventory_id' => 'required|exists:inventories,id',
            'quantity' => 'required|integer|min:1',
        ]);
        // Find the inventory item or fail
        $inventory = Inventory::findOrFail($request->inventory_id);
        // Check if the quantity to consume is greater than available quantity
        if ($request->quantity > $inventory->quantity) {
            return back()->withErrors(['quantity' => 'Quantity to consume cannot be greater than the available quantity.'])
                ->withInput(); // Return back with input to retain form data
        }
        // Update inventory quantity
        // $inventory->quantity -= $request->quantity;
        $inventory->save();
        // Log the consumed quantity
        InventoryConsumed::create([
            'created_by' => auth()->id(),
            'quantity' => $request->quantity,
            'inventory_id' => $inventory->id,
        ]);

        return redirect()->route('inventories.index')->with('success', 'Inventory consumed successfully.');
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Find the inventory item by ID
        $inventory = Inventory::find($id);

        // Get the inventory consumed records that match the current inventory ID
        $consumeInventorys = InventoryConsumed::where('inventory_id', $id)
            ->with('createdBy') // Assuming `createdBy` is a relationship
            ->orderBy('created_at', 'desc') // Optional: order by creation time
            ->get();

        $additionInventorys = InventoryAddition::where('inventory_id', $id)
            ->with('createdBy') // Assuming `createdBy` is a relationship
            ->orderBy('created_at', 'desc') // Optional: order by creation time
            ->get();

        // Pass the inventory and consumed inventory records to the view
        return view('inventory.show', compact('inventory', 'consumeInventorys', 'additionInventorys'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $inventory = Inventory::find($id);

        $items = Item::all();
        $categories = Category::all();
        $subCategories = SubCategory::all();

        // start of log code
        $logs = UserLogs::where('table_name', 'inventories')->orderBy('id', 'desc')
            ->with('user')
            ->paginate(10);
        $logs = '';
        // end of log code
        $consumeInventorys = InventoryConsumed::all();
        return redirect()->route('inventories.index')->with('success', 'Record updated successfully!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $inventory = Inventory::find($id);
        $inventory->item_id = $request->item_id;
        $inventory->category_id = $request->category_id;
        $inventory->subcategory_id = $request->subcategory_id;
        $inventory->quantity = $request->quantity;
        $inventory->unitprice = $request->unitprice;
        $inventory->updated_by = auth()->id();
        $inventory->save();

        // Redirect to the edit page after updating the record
        return redirect()->route('inventories.edit', $inventory->id);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $inventory = Inventory::find($id);
        $inventory->delete();
        return redirect()->route('inventories.index');
    }
}
