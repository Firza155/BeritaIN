<?php
namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NewsController extends Controller
{
    // Dashboard publik: tampilkan berita publish dan filter kategori
    public function publicDashboard(Request $request)
    {
        $query = News::with(['user', 'category'])
            ->where('status', 'published');

        // Filter kategori jika ada
        $categoryId = $request->input('category_id');
        if ($categoryId) {
            $query->where('category_id', $categoryId);
        }

        $berita = $query->orderByDesc('created_at')->paginate(10);
        $categories = Category::withCount(['news' => function ($query) {
            $query->where('status', 'published');
        }])->orderBy('name')->get();
        return view('dashboard_public', compact('berita', 'categories', 'categoryId'));
    }
    // Wartawan: Lihat berita sendiri
    public function index(Request $request)
    {
        $user = Auth::user();
        $query = News::query();

        if ($user->role === 'wartawan') {
            $query->where('user_id', $user->id);
        } else if ($user->role === 'editor') {
            // Editor bisa melihat semua berita kecuali draft orang lain
            $query->where('status', '!=', 'draft');
        }
        // Admin bisa melihat semua

        if ($request->has('status') && in_array($request->status, ['draft', 'pending', 'published', 'rejected'])) {
            $query->where('status', $request->status);
        }

        $news = $query->latest()->get();

        // Menentukan view berdasarkan role
        $view = 'admin.berita.index'; // Default untuk admin
        if (in_array($user->role, ['wartawan', 'editor'])) {
            $view = $user->role . '.berita.index';
        }

        return view($view, compact('news'));
    }

    // Wartawan: Form tambah berita
    public function create()
    {
        $categories = Category::all();
        return view('wartawan.berita.create', compact('categories'));
    }

    // Wartawan: Simpan berita baru
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Validasi untuk gambar
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images/news', 'public');
        }

        $status = $request->input('action') === 'draft' ? 'draft' : 'pending';

        News::create([
            'title' => $request->title,
            'content' => $request->content,
            'image' => $imagePath,
            'user_id' => Auth::id(),
            'category_id' => $request->category_id,
            'status' => $status,
        ]);

        $message = $status === 'draft' 
            ? 'Berita berhasil disimpan sebagai draft.' 
            : 'Berita berhasil diajukan ke editor.';

        return redirect()->route('news.index')->with('success', $message);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $news = News::with(['user', 'category'])->findOrFail($id);
        $user = Auth::user();

        // Wartawan hanya bisa melihat berita sendiri, editor dan admin bisa melihat semua
        if ($user->role === 'wartawan' && $news->user_id !== $user->id) {
            abort(403, 'Anda tidak diizinkan untuk melihat berita ini.');
        }
        
        return view('wartawan.berita.show', compact('news'));
    }

    // Editor/Admin: Approve berita
    public function approve($id)
    {
        $news = News::findOrFail($id);
        $news->status = 'approved';
        $news->save();
        return back()->with('success', 'Berita berhasil di-approve.');
    }

    // Editor/Admin: Revisi berita
    public function revisi($id, Request $request)
    {
        $news = News::findOrFail($id);
        $news->status = 'revisi';
        $news->save();
        // Bisa tambahkan kolom catatan revisi jika ingin
        return back()->with('success', 'Berita dikembalikan untuk revisi.');
    }

    // Admin: Hapus berita
    public function destroy($id)
    {
        $news = News::findOrFail($id);
        $news->delete();
        return back()->with('success', 'Berita berhasil dihapus.');
    }

    // Tambahan: Edit/Update berita (wartawan hanya berita sendiri, admin semua)
    public function edit($id)
    {
        $news = News::findOrFail($id);
        $categories = Category::all();
        $user = Auth::user();
        if ($user->role === 'wartawan' && $news->user_id !== $user->id) {
            abort(403);
        }
        return view($user->role.'.berita.edit', compact('news', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $news = News::findOrFail($id);
        $user = Auth::user();
        if ($user->role === 'wartawan' && $news->user_id !== $user->id) {
            abort(403);
        }
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'category_id' => 'required|exists:categories,id',
        ]);
        $news->update([
            'title' => $request->title,
            'content' => $request->content,
            'category_id' => $request->category_id,
        ]);
        return redirect()->route('news.index')->with('success', 'Berita berhasil diupdate.');
    }

    // Detail berita publik untuk dashboard_public
    public function detailPublic($id)
    {
        $news = News::with(['user', 'category'])->where('status', 'published')->findOrFail($id);
        return view('detail_public', compact('news'));
    }
}
