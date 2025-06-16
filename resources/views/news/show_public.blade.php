<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Berita | BeritaIN</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background: #f8f9fa;
        }
        .news-image {
            width: 100%;
            max-height: 320px;
            object-fit: cover;
            border-radius: 1rem;
        }
        .news-card {
            border-radius: 1rem;
        }
    </style>
</head>
<body>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card news-card shadow mb-4">
                    <div class="card-header bg-primary text-white d-flex flex-column flex-md-row align-items-md-center justify-content-between">
                        <h3 class="m-0">{{ $news->title ?? '-' }}</h3>
                        <span class="badge bg-{{ $news->status == 'published' ? 'success' : ($news->status == 'pending' ? 'warning' : 'secondary') }} ms-md-3">
                            {{ ucfirst($news->status) }}
                        </span>
                    </div>
                    <div class="card-body">
                        <div class="mb-3 text-center">
                            @if(!empty($news->image))
                                <img src="{{ asset('storage/' . $news->image) }}" alt="Gambar Berita" class="news-image shadow-sm">
                            @else
                                <i class="bi bi-image" style="font-size: 5rem; color: #d3d3d3;"></i>
                            @endif
                        </div>
                        <div class="mb-3">
                            <span class="me-3"><i class="bi bi-person-fill text-primary"></i> {{ $news->user->name ?? '-' }}</span>
                            <span class="me-3"><i class="bi bi-folder-fill text-info"></i> {{ $news->category->name ?? 'Tanpa Kategori' }}</span>
                            <span class="me-3"><i class="bi bi-calendar-event text-secondary"></i> {{ $news->created_at ? $news->created_at->format('d M Y H:i') : '-' }}</span>
                        </div>
                        <div style="font-size:1.1rem; line-height:1.7;">
                            {!! $news->content ?? '-' !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
