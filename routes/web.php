<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Password;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\BeritaController as AdminBeritaController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\KategoriController as AdminKategoriController;
use App\Http\Controllers\Admin\ApprovalController as AdminApprovalController;
use App\Http\Controllers\Editor\BeritaController as EditorBeritaController;
use App\Http\Controllers\Editor\ApprovalController as EditorApprovalController;
use App\Http\Controllers\Wartawan\BeritaController as WartawanBeritaController;
use App\Http\Controllers\NewsController;

// ========================
// ROUTE CRUD & APPROVAL BERITA (ROLE-BASED)
// ========================

// Dashboard publik untuk user umum (tidak perlu login)
Route::get('/', [App\Http\Controllers\NewsController::class, 'publicDashboard'])->name('dashboard.public');
// Detail berita publik khusus dashboard_public
Route::get('/detail/{id}', [App\Http\Controllers\NewsController::class, 'detailPublic'])->name('news.detail.public');
Route::middleware(['auth'])->group(function () {
    // CRUD Berita (hanya berita sendiri untuk wartawan, semua untuk admin)
    Route::get('/news', [NewsController::class, 'index'])->name('news.index');
    Route::get('/news/create', [NewsController::class, 'create'])->name('news.create');
    Route::post('/news', [NewsController::class, 'store'])->name('news.store');
    Route::get('/news/{id}', [NewsController::class, 'show'])->name('news.show');
    Route::get('/news/{id}/edit', [NewsController::class, 'edit'])->name('news.edit');
    Route::put('/news/{id}', [NewsController::class, 'update'])->name('news.update');
    Route::delete('/news/{id}', [NewsController::class, 'destroy'])->name('news.destroy');
    // Approval (editor/admin)
    Route::post('/news/{id}/approve', [NewsController::class, 'approve'])->name('news.approve');
    Route::post('/news/{id}/revisi', [NewsController::class, 'revisi'])->name('news.revisi');
});

// ========================
// AUTHENTICATION ROUTES
// ========================
Route::get('/login', [AuthController::class, 'showLogin'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::get('/register', [AuthController::class, 'showRegister'])->name('register.form');
Route::post('/register', [AuthController::class, 'register'])->name('register');

// ========================
// PASSWORD RESET ROUTES
// ========================
// Route GET forgot-password di luar middleware guest
Route::get('/forgot-password', function (\Illuminate\Http\Request $request) {
    if (auth()->check()) {
        auth()->logout();
        session()->invalidate();
        session()->regenerateToken();
    }
    if (!$request->has('email') || empty($request->email)) {
        return redirect()->route('login.form')->withErrors(['email' => 'Silakan isi email terlebih dahulu sebelum reset password.']);
    }
    return view('auth.passwords.email');
})->name('password.request');

Route::middleware('guest')->group(function () {

    Route::post('/forgot-password', function (\Illuminate\Http\Request $request) {
    $request->validate(['email' => 'required|email']);
    $user = \App\Models\User::where('email', $request->email)->first();
    if ($user) {
        session(['reset_email' => $request->email]);
        return redirect()->route('password.set.form');
    } else {
        return back()->withErrors(['email' => 'Email tidak terdaftar.']);
    }
})->name('password.email');

// Form set password langsung tanpa token email
Route::get('/set-password', function () {
    if (!session('reset_email')) {
        return redirect()->route('password.request');
    }
    return view('auth.passwords.set-password');
})->name('password.set.form');

// Proses set password
Route::post('/set-password', function (\Illuminate\Http\Request $request) {
    $request->validate([
        'email' => 'required|email',
        'password' => 'required|min:8|confirmed',
    ]);
    $user = \App\Models\User::where('email', $request->email)->first();
    if ($user) {
        $user->password = bcrypt($request->password);
        $user->save();
        session()->forget('reset_email');
        return redirect()->route('login.form')->with('status', 'Kata sandi berhasil diubah. Silakan login dengan kata sandi baru.');
    } else {
        return back()->withErrors(['email' => 'Email tidak ditemukan.']);
    }
})->name('password.set');

    Route::get('/reset-password/{token}', function (string $token) {
        return view('auth.passwords.reset', ['token' => $token]);
    })->name('password.reset');

    Route::post('/reset-password', function (\Illuminate\Http\Request $request) {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => bcrypt($password)
                ])->save();
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login.form')->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    })->name('password.update');
});

// ========================
// LOGOUT & GENERIC DASHBOARD
// ========================
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        $user = auth()->user();
        
        if (!$user) {
            return redirect()->route('login.form');
        }
        
        switch ($user->role) {
            case 'admin':
                return redirect()->route('admin.dashboard');
            case 'editor':
                return redirect()->route('editor.dashboard');
            case 'wartawan':
                return redirect()->route('wartawan.dashboard');
            default:
                Auth::logout();
                return redirect('/login')->with('error', 'Role tidak valid');
        }
    })->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

// ========================
// ROUTE DASHBOARD & FITUR
// ========================

// Route global universal untuk create berita (agar semua role bisa akses route('berita.create'))
Route::middleware('auth')->get('/berita/create', function() {
    return redirect()->route('news.create');
})->name('berita.create');

// Route global universal untuk index berita (agar semua role bisa akses route('berita.index'))
Route::middleware('auth')->get('/berita', function() {
    $role = auth()->user()->role;
    return redirect()->route($role . '.berita.index');
})->name('berita.index');

// Route global universal untuk kategori (agar semua role bisa akses route('kategori.index'))
Route::middleware('auth')->get('/kategori', function() {
    $role = auth()->user()->role;
    return redirect()->route($role . '.kategori.index');
})->name('kategori.index');

// Route global universal untuk user index (agar semua role bisa akses route('user.index'))
Route::middleware('auth')->get('/user', function() {
    $role = auth()->user()->role;
    return redirect()->route($role . '.user.index');
})->name('user.index');

// Route global universal untuk berita saya (agar semua role bisa akses route('berita.saya'))
Route::middleware('auth')->get('/berita-saya', function() {
    $role = auth()->user()->role;
    // Hanya wartawan yang punya route ini, role lain bisa diarahkan ke dashboard atau error
    if ($role === 'wartawan') {
        return redirect()->route('wartawan.berita.saya');
    }
    return redirect()->route($role . '.dashboard');
})->name('berita.saya');

// Route global universal untuk wartawan.berita.saya (agar semua role bisa akses route('wartawan.berita.saya'))
Route::middleware('auth')->get('/wartawan/berita-saya', function() {
    return redirect()->route('wartawan.berita.saya');
})->name('wartawan.berita.saya');

// Alias untuk route wartawan.berita-saya jika ada pemanggilan route('wartawan.berita-saya')
Route::middleware('auth')->get('/wartawan/berita-saya', function() {
    return redirect()->route('wartawan.berita.saya');
})->name('wartawan.berita-saya');

// Route global universal untuk approval (agar semua role bisa akses route('approval.index'))
Route::middleware('auth')->get('/approval', function() {
    $role = auth()->user()->role;
    return redirect()->route($role . '.approval.index');
})->name('approval.index');

// ---------- Admin Routes ----------
Route::middleware(['auth', \App\Http\Middleware\RoleMiddleware::class . ':admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::delete('/user/{id}', [\App\Http\Controllers\Admin\UserController::class, 'destroy'])->name('user.destroy');
    Route::get('/user', [\App\Http\Controllers\Admin\UserController::class, 'index'])->name('user.index');
    Route::post('/kategori', [\App\Http\Controllers\Admin\KategoriController::class, 'store'])->name('kategori.store');
    Route::delete('/kategori/{id}', [\App\Http\Controllers\Admin\KategoriController::class, 'destroy'])->name('kategori.destroy');
    Route::get('/kategori', [\App\Http\Controllers\Admin\KategoriController::class, 'index'])->name('kategori.index');
    Route::get('/berita/pending', [\App\Http\Controllers\Admin\BeritaController::class, 'pending'])->name('berita.pending');
    Route::post('/berita/{id}/approve', [\App\Http\Controllers\Admin\BeritaController::class, 'approve'])->name('berita.approve');
    Route::post('/berita/{id}/reject', [\App\Http\Controllers\Admin\BeritaController::class, 'reject'])->name('berita.reject');
    Route::resource('berita', \App\Http\Controllers\Admin\BeritaController::class)->except(['create', 'edit', 'show', 'update', 'store']);
    Route::get('/dashboard', [DashboardController::class, 'admin'])->name('dashboard');
    
    // Route untuk manajemen user
    Route::get('/user', [AdminUserController::class, 'index'])->name('user.index');
    
    // Route untuk manajemen kategori
    Route::get('/kategori', [AdminKategoriController::class, 'index'])->name('kategori.index');
    
    // Route untuk manajemen berita
    Route::get('/berita', [AdminBeritaController::class, 'index'])->name('berita.index');
    // Route untuk detail berita (show)
    Route::get('/berita/{id}', [AdminBeritaController::class, 'show'])->name('berita.show');
    // Route untuk edit berita
    Route::get('/berita/{id}/edit', [AdminBeritaController::class, 'edit'])->name('berita.edit');

    
    // Route untuk approval berita
    Route::get('/approval-berita', [AdminApprovalController::class, 'index'])->name('approval.index');
    
    // Route untuk mengubah status berita
    Route::get('/status', [AdminBeritaController::class, 'status'])->name('status.index');
    
    // Route untuk mengubah role user
    Route::get('/role', [AdminUserController::class, 'role'])->name('role.index');
});

// ---------- Editor Routes ----------
Route::middleware(['auth', \App\Http\Middleware\RoleMiddleware::class . ':editor'])->prefix('editor')->name('editor.')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Editor\DashboardController::class, 'index'])->name('dashboard');
    
    // Route untuk daftar berita
    Route::get('/berita', [EditorBeritaController::class, 'index'])->name('berita.index');
    // Route untuk daftar berita published
    Route::get('/berita/published', [EditorBeritaController::class, 'published'])->name('berita.published');
    // Route untuk daftar berita draft
    Route::get('/berita/draft', [EditorBeritaController::class, 'draft'])->name('berita.draft');
    // Route untuk detail berita
    Route::get('/berita/{id}', [EditorBeritaController::class, 'show'])->name('berita.show');

    
    // Route untuk approval berita
    Route::get('/approval', [EditorApprovalController::class, 'index'])->name('approval.index');
    // Route untuk edit approval berita
    Route::get('/approval/{id}/edit', [EditorApprovalController::class, 'edit'])->name('approval.edit');
    // Route approve berita
    Route::post('/approval/{id}/approve', [EditorApprovalController::class, 'approve'])->name('approval.approve');
    // Route reject berita
    Route::post('/approval/{id}/reject', [EditorApprovalController::class, 'reject'])->name('approval.reject');
    
    // Route untuk status berita
    Route::get('/status', [EditorBeritaController::class, 'status'])->name('status.index');
});

// ---------- Wartawan Routes ----------
Route::middleware(['auth', \App\Http\Middleware\RoleMiddleware::class . ':wartawan'])->prefix('wartawan')->name('wartawan.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'wartawan'])->name('dashboard');
    
    // Route untuk berita saya
    Route::get('/berita-saya', [WartawanBeritaController::class, 'beritaSaya'])->name('berita.saya');
    // Alias route untuk wartawan.berita-saya
    Route::get('/berita-saya', [WartawanBeritaController::class, 'beritaSaya'])->name('berita-saya');
    
    // Route untuk edit berita
    Route::get('/edit-berita/{id}', [WartawanBeritaController::class, 'edit'])->name('berita.edit');
});
