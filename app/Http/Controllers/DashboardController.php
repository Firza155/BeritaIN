<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Kategori;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    /**
     * Show the admin dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function admin()
    {
        $totalBerita = News::count();
        $totalKategori = Kategori::count();
        $totalUser = User::count();
        $pendingApproval = News::where('status', 'pending')->count();
        
        $recentBerita = News::with(['category', 'user'])
            ->latest()
            ->take(5)
            ->get();
            
        $statusCounts = [
            'draft' => News::where('status', 'draft')->count(),
            'pending' => $pendingApproval,
            'published' => News::where('status', 'published')->count(),
            'rejected' => News::where('status', 'rejected')->count(),
        ];

        return view('admin.dashboard', compact(
            'totalBerita', 
            'totalKategori', 
            'totalUser', 
            'pendingApproval',
            'recentBerita',
            'statusCounts'
        ));
    }

    /**
     * Show the editor dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function editor()
    {
        $userId = Auth::id();
        
        $totalBeritaSaya = News::where('user_id', $userId)->count();
        $publishedBerita = News::where('user_id', $userId)->where('status', 'published')->count();
        $pendingApproval = News::where('user_id', $userId)->where('status', 'pending')->count();
        $draftBerita = News::where('user_id', $userId)->where('status', 'draft')->count();
        $rejectedBerita = News::where('user_id', $userId)->where('status', 'rejected')->count();
        
        $recentBerita = News::where('user_id', $userId)
            ->with(['category'])
            ->latest()
            ->take(5)
            ->get();
            
        // Get pending approvals for editor to review
        $pendingApprovals = News::where('status', 'pending')
            ->where('user_id', '!=', $userId) // Exclude own posts
            ->with(['user', 'category'])
            ->latest()
            ->take(5)
            ->get();
            
        // Monthly statistics for the current year
        $monthlyStats = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
        $monthlyData = News::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->where('user_id', $userId)
            ->whereYear('created_at', date('Y'))
            ->groupBy('month')
            ->get();
            
        foreach ($monthlyData as $data) {
            $monthlyStats[$data->month - 1] = $data->count;
        }

        return view('editor.dashboard', compact(
            'totalBeritaSaya',
            'publishedBerita',
            'pendingApproval',
            'draftBerita',
            'rejectedBerita',
            'recentBerita',
            'pendingApprovals',
            'monthlyStats'
        ));
    }

    /**
     * Show the wartawan dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function wartawan()
    {
        $userId = Auth::id();
        
        $totalBerita = News::where('user_id', $userId)->count();
        $publishedBerita = News::where('user_id', $userId)->where('status', 'published')->count();
        $pendingBerita = News::where('user_id', $userId)->where('status', 'pending')->count();
        $draftBerita = News::where('user_id', $userId)->where('status', 'draft')->count();
        $rejectedBerita = News::where('user_id', $userId)->where('status', 'rejected')->count();
        
        $recentBerita = News::where('user_id', $userId)
            ->with(['category'])
            ->latest()
            ->take(5)
            ->get();

        return view('wartawan.dashboard', compact(
            'totalBerita',
            'publishedBerita',
            'pendingBerita',
            'draftBerita',
            'rejectedBerita',
            'recentBerita'
        ));
    }
}
