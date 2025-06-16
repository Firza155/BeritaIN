<?php

namespace App\Http\Controllers\Wartawan;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('wartawan.dashboard.index', compact('user'));
    }
}
