<?php

namespace App\Http\Controllers\Editor;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // Total berita di web
        $totalBerita = \App\Models\News::count();
        // Total berita diterbitkan
        $publishedBerita = \App\Models\News::where('status', 'published')->count();
        // Total berita menunggu approval
        $approvalBerita = \App\Models\News::where('status', 'pending')->count();
        // Total draft berita
        $draftBerita = \App\Models\News::where('status', 'draft')->count();
        // Berita menunggu approval
        $pendingBerita = \App\Models\News::with(['kategori', 'user'])
            ->where('status', 'pending')
            ->orderByDesc('created_at')
            ->get();
        return view('editor.dashboard.index', compact(
            'totalBerita',
            'publishedBerita',
            'approvalBerita',
            'draftBerita',
            'pendingBerita'
        ));
    }
}
