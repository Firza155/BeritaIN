<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Berita | BeritaIN</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body { background: #f8f9fa; }
        .news-image {
            width: 100%;
            height: 220px;
            object-fit: cover;
            border-radius: 1rem 1rem 0 0;
        }
        .news-card {
            border-radius: 1rem;
            border: none;
            box-shadow: 0 2px 8px rgba(0,0,0,0.06);
        }
        .news-title {
            font-size: 1.5rem;
            font-weight: 700;
        }
        .news-meta {
            color: #6c757d;
            font-size: 0.95rem;
        }
    </style>
</head>
<body>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card news-card mb-4">
                    @if(!empty($news->image))
                        <img src="{{ asset('storage/' . $news->image) }}" alt="Gambar Berita" class="news-image">
                    @else
                        <div class="d-flex align-items-center justify-content-center bg-light news-image" style="height:220px;">
                            <i class="bi bi-image" style="font-size: 4rem; color: #d3d3d3;"></i>
                        </div>
                    @endif
                    <div class="card-body">
                        <div class="news-title mb-2">{{ $news->title ?? '-' }}</div>
                        <div class="news-meta mb-3">
                            <span class="me-3"><i class="bi bi-person-fill text-primary"></i> {{ $news->user->name ?? '-' }}</span>
                            <span class="me-3"><i class="bi bi-folder-fill text-info"></i> {{ $news->category->name ?? 'Tanpa Kategori' }}</span>
                            <span class="me-3"><i class="bi bi-calendar-event text-secondary"></i> {{ $news->created_at ? $news->created_at->format('d M Y H:i') : '-' }}</span>
                        </div>
                        <div style="font-size:1.1rem; line-height:1.7;">
                            {!! $news->content ?? '-' !!}
                        </div>
                    </div>
                </div>
                <div class="text-center">
                    <a href="{{ url()->previous() }}" class="btn btn-outline-secondary"><i class="bi bi-arrow-left"></i> Kembali</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
