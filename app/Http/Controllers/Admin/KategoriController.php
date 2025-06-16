<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
        ]);
        \App\Models\Category::create([
            'name' => $request->name
        ]);
        return redirect()->route('admin.kategori.index')->with('success', 'Kategori berhasil ditambahkan!');
    }

    public function index(Request $request)
    {
        $q = $request->q;
        $categories = \App\Models\Category::when($q, function($query, $q) {
                return $query->where('name', 'like', "%$q%") ;
            })
            ->orderBy('created_at', 'desc')
            ->get();
        return view('admin.kategori.index', compact('categories', 'q'));
    }

    public function destroy($id)
    {
        $kategori = \App\Models\Category::findOrFail($id);
        $kategori->delete();
        return redirect()->route('admin.kategori.index')->with('success', 'Kategori berhasil dihapus!');
    }

    //
}
