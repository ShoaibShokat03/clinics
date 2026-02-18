<?php

namespace App\Http\Controllers;
use App\Models\UserLogs;
use App\Models\Item;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ItemController extends Controller
{

    public function index(Request $request)
    {
        $categories = Category::where('status', '1')->get();
        $subcategories = Subcategory::where('status', '1')->get();

        $items = $this->filter($request)->orderBy('id', 'desc')->paginate(10);

        return view('items.index', compact('items', 'categories', 'subcategories'));
    }
    private function filter(Request $request)
    {
        $query = Item::query();

        if ($request->has('title')) {
            $query->where('title', 'like', $request->input('title') . '%');
        }

        if ($request->has('description')) {
            $query->where('description', 'like', $request->input('description') . '%');
        }

        if ($request->category_id) {
            $query->where('category_id', $request->category_id);
        }
        if ($request->subcategory_id) {
            $query->where('subcategory_id', $request->subcategory_id);
        }
        return $query;
    }


    public function create()
    {
        $categories = Category::all();
        $subcategories = SubCategory::all();

        return view('items.create',compact('categories', 'subcategories'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'category_id' => 'required',
            'subcategory_id' => 'nullable',
            'title' => 'required',
        ]);

        $treatmentplan = new Item();
        $treatmentplan->title = $request->input('title');
        $treatmentplan->description = $request->input('description');
        $treatmentplan->category_id = $request->input('category_id');
        $treatmentplan->subcategory_id = $request->input('subcategory_id');
        $treatmentplan->created_by = Auth::id();

        $treatmentplan->save();

        return redirect()->route('items.edit', ['item' => $treatmentplan->id])
            ->with('success', 'Item created successfully.');
    }

    public function show(Item $item)
    {
        return view('items.show', compact('item'));
    }

    public function edit(Item $item)
    {
        $subcategories =SubCategory::get();
        $categories =Category::get();

        return view('items.edit', compact('item','subcategories','categories'));
    }

    public function update(Request $request, Item $item)

    {


        $validatedData = $request->validate([
            'category_id' => 'required',
            'subcategory_id' => 'nullable',
            'title' => 'required',
            'description' => 'nullable',
            'status' => 'nullable',
        ]);
        $data = $validatedData;
        $data['updated_by'] = auth()->id();

        $item->update($data);

        return redirect()->route('items.edit', ['item' => $item->id])
        ->with('success', 'Item updated successfully.');
    }

    public function destroy(Item $item)
    {
        $item->delete();

        return redirect()->route('items.index')
            ->with('success', 'Item deleted successfully');
    }
    public function getsubcategories(Request $request)
    {
        $categoryId = $request->get('category_id');
        $subcategories =SubCategory ::get('title')->where('category_id', $categoryId)->get();
$abc=22;
        // return response()->json($subcategories);
        return response()->json($abc);
    }
}
