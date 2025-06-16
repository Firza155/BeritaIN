<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->q;
        $users = \App\Models\User::when($q, function($query, $q) {
                return $query->where('name', 'like', "%$q%")
                    ->orWhere('email', 'like', "%$q%") ;
            })
            ->orderBy('created_at', 'desc')
            ->get();
        return view('admin.user.index', compact('users', 'q'));
    }

    public function destroy($id)
    {
        $user = \App\Models\User::findOrFail($id);
        $user->delete();
        return redirect()->route('admin.user.index')->with('success', 'User berhasil dihapus!');
    }

    //
}
