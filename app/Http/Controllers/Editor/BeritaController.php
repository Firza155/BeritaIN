<?php

namespace App\Http\Controllers\Editor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    public function index()
    {
        $daftarBerita = \App\Models\News::with(['kategori', 'user'])
            ->orderByDesc('created_at')
            ->paginate(10);
        return view('editor.berita.index', compact('daftarBerita'));
    }

    public function show($id)
    {
        $berita = \App\Models\News::with(['kategori', 'user'])->findOrFail($id);
        return view('editor.berita.show', compact('berita'));
    }

    public function published()
    {
        $publishedBerita = \App\Models\News::with(['kategori', 'user'])
            ->where('status', 'published')
            ->orderByDesc('created_at')
            ->paginate(10);
        return view('editor.berita.published', compact('publishedBerita'));
    }

    public function draft()
    {
        $draftBerita = \App\Models\News::with(['kategori', 'user'])
            ->where('status', 'draft')
            ->orderByDesc('created_at')
            ->paginate(10);
        return view('editor.berita.draft', compact('draftBerita'));
    }
}

