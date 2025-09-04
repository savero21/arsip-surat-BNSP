<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('kode_kategori')->get();
        return view('categories.index', compact('categories'));
    }

    // public function create()
    // {
    //     return view('categories.create');
    // }
public function create()
{
    // cari kode kategori terkecil yang belum dipakai
    $usedCodes = Category::pluck('kode_kategori')->toArray();
    $nextKode = 1;
    while (in_array($nextKode, $usedCodes)) {
        $nextKode++;
    }

    return view('categories.create', [
        'nextKodeKategori' => $nextKode
    ]);
}

  public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
    ]);

    Category::create([
        'kode_kategori' => $request->kode_kategori, // auto dari controller
        'name' => $request->name,
        'description' => $request->description,
    ]);

    return redirect()->route('categories.index')->with('success', 'Kategori berhasil ditambahkan');
}


    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $category->update([
            'name' => $request->name,
            'description' => $request->description,
            // kode_kategori tidak diubah supaya tetap stabil
        ]);

        return redirect()->route('categories.index')->with('success', 'Kategori berhasil diperbarui');
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Kategori berhasil dihapus');
    }
}
