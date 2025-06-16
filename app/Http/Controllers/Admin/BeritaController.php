<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    public function destroy($id)
    {
        $berita = \App\Models\News::findOrFail($id);
        $berita->delete();
        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil dihapus!');
    }

    public function index()
    {
        $berita = \App\Models\News::with(['category', 'user'])->latest()->get();
        return view('admin.berita.index', compact('berita'));
    }

    public function approve($id)
    {
        $berita = \App\Models\News::findOrFail($id);
        $berita->status = 'published';
        $berita->save();
        return redirect()->back()->with('success', 'Berita berhasil di-approve!');
    }

    public function reject($id)
    {
        $berita = \App\Models\News::findOrFail($id);
        $berita->status = 'rejected';
        $berita->save();
        return redirect()->back()->with('success', 'Berita berhasil di-reject!');
    }

    public function approval()
    {
        $pendingBerita = \App\Models\News::with(['category', 'user'])
            ->where('status', 'pending')
            ->get();
        return view('admin.berita.approval-berita', compact('pendingBerita'));
    }

    // Kompatibilitas agar /berita/pending tetap bisa
    public function pending()
    {
        return $this->approval();
    }

    //
}
