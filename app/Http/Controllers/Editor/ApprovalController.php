<?php

namespace App\Http\Controllers\Editor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApprovalController extends Controller
{
    public function index()
    {
        $pendingBerita = \App\Models\News::with(['kategori', 'user'])
            ->where('status', 'pending')
            ->orderByDesc('created_at')
            ->paginate(10);
        return view('editor.approval.index', compact('pendingBerita'));
    }

    public function edit($id)
    {
        $berita = \App\Models\News::with(['kategori', 'user'])->findOrFail($id);
        return view('editor.approval.edit', compact('berita'));
    }

    public function approve($id)
    {
        $berita = \App\Models\News::findOrFail($id);
        $berita->status = 'published';
        $berita->save();
        return redirect()->route('editor.dashboard')->with('success', 'Berita berhasil di-approve dan diterbitkan!');
    }

    public function reject($id, \Illuminate\Http\Request $request)
    {
        $request->validate([
            'alasan' => 'required|string|max:255',
        ]);
        $berita = \App\Models\News::findOrFail($id);
        $berita->status = 'rejected';
        $berita->keterangan_ditolak = $request->alasan;
        $berita->save();
        return redirect()->route('editor.approval.index')->with('success', 'Berita berhasil ditolak.');
    }
}

