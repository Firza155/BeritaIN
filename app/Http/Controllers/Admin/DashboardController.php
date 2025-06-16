<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Berita;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        // Ambil 5 berita terbaru beserta kategori dan user (penulis)
        $berita_terbaru = Berita::with(['kategori', 'user'])->orderBy('created_at', 'desc')->take(5)->get();
        return view('admin.dashboard', compact('user', 'berita_terbaru'));
    }
}
