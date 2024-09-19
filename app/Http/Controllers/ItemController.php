<?php

// app/Http/Controllers/ItemController.php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index()
    {
        $items = Item::all(); 
        return view('admin.dashboard', compact('items'));
    }

    public function create()
    {
        return view('admin.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        Item::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Item created successfully.');
    }

    public function show(Item $item)
    {
        return view('admin.table', compact('item'));
    }

    public function edit($id)
    {
        $item = Item::findOrFail($id); 
        return view('items.edit', compact('item'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        $item = Item::findOrFile($id);
        $item->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect()->route('admin.table')->with('success', 'Item updated successfully.');
    }

    public function destroy($id)
    {
        $item = Item::findOrFail($id);
        $item->delete();

        return redirect()->route('admin.table')->with('success', 'Item deleted successfully.');
    }
}
