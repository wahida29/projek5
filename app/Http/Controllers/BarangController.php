<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use Illuminate\Support\Facades\Storage;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $menus = Menu::all();
        return view('barang.index', compact('menus'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('barang.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category' => 'required|in:kopi,nonkopi',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle upload gambar
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('menus', 'public');
            $validated['image'] = $path;
        }

        // Simpan data ke database
        Menu::create($validated);

        return redirect()->route('barang.index')->with('success', 'Barang berhasil ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $menu = Menu::findOrFail($id);
        return view('barang.edit', compact('menu'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $menu = Menu::findOrFail($id);

        // Validasi input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category' => 'required|in:kopi,nonkopi',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle upload gambar baru
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($menu->image) {
                Storage::disk('public')->delete($menu->image);
            }
            $path = $request->file('image')->store('menus', 'public');
            $validated['image'] = $path;
        }

        // Update data di database
        $menu->update($validated);

        return redirect()->route('barang.index')->with('success', 'Barang berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $menu = Menu::findOrFail($id);

        // Hapus gambar jika ada
        if ($menu->image) {
            Storage::disk('public')->delete($menu->image);
        }

        // Hapus data dari database
        $menu->delete();

        return redirect()->route('barang.index')->with('success', 'Barang berhasil dihapus');
    }
    public function showKopi()
{
    $menus = Menu::where('category', 'kopi')->get();
    return view('kopi', compact('menus'));
}

public function showNonKopi()
{
    $menus = Menu::where('category', 'nonkopi')->get();
    return view('nonkopi', compact('menus'));
}
public function apiKopi()
{
    $kopi = menu::where('category', 'kopi')->get();
    return response()->json([
        'status' => 'success',
        'data' => $kopi
    ]);
}

public function apiNonKopi()
{
    $nonkopi = menu::where('category', 'nonkopi')->get();
    return response()->json([
        'status' => 'success',
        'data' => $nonkopi
    ]);
}
public function storeKopi(Request $request)
{
    $request->validate([
    'name' => 'required|string|max:255',
    'description' => 'nullable|string',
    'price' => 'required|numeric',
]);


    $barang = Menu::create([
        'name' => $request->name,
        'description' => $request->description,
        'category' => 'kopi',
        'price' => $request->price,
    ]);

    return response()->json([
        'status' => 'success',
        'data' => $barang
    ], 201);
}

public function storeNonKopi(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'price' => 'required|numeric',
        'image' => 'nullable|string',
    ]);

    $barang = Menu::create([
        'name' => $request->name,
        'description' => $request->description,
        'category' => 'nonkopi',
        'price' => $request->price,
        'image' => $request->image,
    ]);

    return response()->json([
        'status' => 'success',
        'data' => $barang
    ], 201);
}
public function apiUpdateKopi(Request $request, $id)
{
    $barang = Menu::findOrFail($id);

    $request->validate([
        'name' => 'sometimes|required|string|max:255',
        'description' => 'nullable|string',
        'price' => 'sometimes|required|numeric',
        'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
    ]);

    // Update data biasa
    $barang->name = $request->name ?? $barang->name;
    $barang->description = $request->description ?? $barang->description;
    $barang->price = $request->price ?? $barang->price;
    $barang->category = 'kopi';

    $barang->save();
    return response()->json([
        'status' => 'success',
        'data' => $barang
    ], 200);
}
public function apiDeleteKopi($id)
{
    $barang = Menu::findOrFail($id);

    $barang->delete();
    return response()->json([
        'status' => 'success',
        'message' => 'Barang berhasil dihapus'
    ], 200);
}
public function apiUpdateNonkopi(Request $request, $id)
{
    $barang = Menu::findOrFail($id);

    $request->validate([
        'name' => 'sometimes|required|string|max:255',
        'description' => 'nullable|string',
        'price' => 'sometimes|required|numeric',
        'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
    ]);

    // Update data biasa
    $barang->name = $request->name ?? $barang->name;
    $barang->description = $request->description ?? $barang->description;
    $barang->price = $request->price ?? $barang->price;
    $barang->category = 'nonkopi';

    $barang->save();
    return response()->json([
        'status' => 'success',
        'data' => $barang
    ], 200);
}
public function apiDeleteNonKopi($id)
{
    $barang = Menu::findOrFail($id);

    $barang->delete();
    return response()->json([
        'status' => 'success',
        'message' => 'Barang berhasil dihapus'
    ], 200);
}
}
