<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    // Menampilkan form login
    public function showLogin()
    {
        return view('auth.login');
    }

    // Proses login
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials, $request->remember)) {
            $user = Auth::user();

            switch ($user->role) {
                case 'admin':
                    return redirect()->route('admin.dashboard');
                case 'editor':
                    return redirect()->route('editor.dashboard');
                case 'wartawan':
                    return redirect()->route('wartawan.dashboard');
                default:
                    Auth::logout();
                    return redirect('/login')->withErrors(['role' => 'Role tidak valid.']);
            }
        }

        return back()->withErrors(['email' => 'Email atau password salah.']);
    }

    // Menampilkan form register
    public function showRegister()
    {
        return view('auth.register');
    }

    // Proses registrasi
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed|min:8',
            'role'     => ['required', 'string', 'in:editor,wartawan'], // hanya editor & wartawan
        ]);

        // Validasi role (jika kamu punya static $roles di User model)
        if (property_exists(User::class, 'roles') && !in_array($validated['role'], User::$roles)) {
            return back()->withInput()->withErrors([
                'role' => 'Role yang dipilih tidak valid.'
            ]);
        }

        try {
            // Buat user baru
            $user = User::create([
                'name'     => $validated['name'],
                'email'    => $validated['email'],
                'password' => Hash::make($validated['password']),
                'role'     => $validated['role'],
            ]);

            // Login user
            Auth::login($user);

            // Redirect sesuai role
            return redirect()->route($user->role . '.dashboard')
                ->with('status', 'Registrasi berhasil! Selamat datang di dashboard ' . ucfirst($user->role));
        } catch (\Exception $e) {
            \Log::error('Registration error: ' . $e->getMessage());

            return back()->withInput()->withErrors([
                'email' => 'Terjadi kesalahan saat registrasi. Silakan coba lagi.'
            ]);
        }
    }

    // Logout user
    public function logout(Request $request)
    {
        Auth::logout();
        Session::flush();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('status', 'Berhasil logout!');
    }
}
