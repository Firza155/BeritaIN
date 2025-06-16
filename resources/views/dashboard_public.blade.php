<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BeritaIN - Portal Berita Publik</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body { background: #f7f9fb; }
    </style>
</head>
<body>
<div class="container-fluid bg-light min-vh-100" style="padding-top: 40px; padding-bottom: 40px;">
    <!-- Header dan Login -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="fw-bold" style="color: #4666FF;">BeritaIN</h1>
            <p class="text-secondary mb-0">Portal berita terkini, terverifikasi, dan informatif untuk semua.</p>
        </div>
        <div>
            <a href="{{ route('login') }}" class="btn btn-outline-primary px-4">Login</a>
        </div>
    </div>

    <!-- Filter Kategori -->
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <form class="row g-2 align-items-center" method="GET" action="{{ route('dashboard.public') }}">
                <div class="col-auto fw-semibold">Filter Kategori:</div>
                <div class="col-md-3 col-6">
                    <select class="form-select" name="category_id">
    <option value="">Semua Kategori</option>
    @foreach($categories as $category)
        <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
    @endforeach
</select>
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary">Tampilkan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Daftar Berita -->
    <div class="row g-4">
        @forelse($berita as $item)
        <div class="col-md-4 col-sm-6">
            <div class="card h-100 shadow-sm">
                @if($item->image)
    <img src="{{ asset('storage/' . $item->image) }}" class="card-img-top rounded-top" style="height: 180px; width: 100%; object-fit: cover;" alt="{{ $item->title }}">
@else
    <div class="card-img-top d-flex align-items-center justify-content-center bg-light rounded-top" style="height: 180px;">
        <i class="bi bi-image" style="font-size: 48px; color: #adb5bd;"></i>
    </div>
@endif
                <div class="card-body">
                    <h6 class="fw-semibold mb-1" style="color: #4666FF;">
                        <a href="{{ route('news.show', $item->id) }}" class="text-decoration-none" style="color: #4666FF;">{{ $item->title }}</a>
                    </h6>
                    <span class="badge" style="background: #39B8FF; color: white; font-size: 0.8rem;">{{ $item->category->name ?? '-' }}</span>
                    <p class="mt-2 mb-2 text-muted" style="font-size: 0.95rem;">{{ Str::limit($item->summary, 40) }}</p>
                </div>
                <div class="card-footer bg-white d-flex justify-content-between align-items-center">
                    <small class="text-muted"><i class="bi bi-calendar"></i> {{ $item->created_at->format('d M Y') }}</small>
                    <a href="{{ route('news.detail.public', $item->id) }}" class="btn btn-outline-primary btn-sm">Lihat Detail</a>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <div class="alert alert-info text-center">Belum ada berita untuk ditampilkan.</div>
        </div>
        @endforelse
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
