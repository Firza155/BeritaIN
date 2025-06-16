@extends('layouts.app')

@section('title', 'Detail Berita')

@section('content')
<div class="container-fluid px-4 py-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-column flex-md-row align-items-md-center justify-content-between bg-primary">
                    <h3 class="m-0 font-weight-bold text-white">{{ $berita->title ?? '-' }}</h3>
                    <span class="badge badge-{{ $berita->status == 'published' ? 'success' : ($berita->status == 'pending' ? 'warning' : 'secondary') }} ml-md-3">
                        {{ ucfirst($berita->status) }}
                    </span>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6 mb-2">
                            <i class="fas fa-user text-primary"></i> <strong>Penulis:</strong> {{ $berita->user->name ?? '-' }}
                        </div>
                        <div class="col-md-6 mb-2">
                            <i class="fas fa-folder text-info"></i> <strong>Kategori:</strong> {{ $berita->kategori->nama ?? 'Tanpa Kategori' }}
                        </div>
                        <div class="col-md-6 mb-2">
                            <i class="fas fa-calendar-alt text-secondary"></i> <strong>Tanggal:</strong> {{ $berita->created_at ? $berita->created_at->format('d M Y H:i') : '-' }}
                        </div>
                        <div class="col-md-6 mb-2">
                            <i class="fas fa-eye text-success"></i> <strong>Status:</strong> {{ ucfirst($berita->status) }}
                        </div>
                    </div>
                    @if(!empty($berita->image))
                        <div class="text-center mb-4">
                            <img src="{{ asset('storage/' . $berita->image) }}" alt="Gambar Berita" class="img-fluid rounded shadow-sm" style="max-height:320px;">
                        </div>
                    @endif
                    <div class="mb-3" style="font-size:1.1rem; line-height:1.7;">
                        {!! $berita->content ?? '-' !!}
                    </div>
                </div>
                <div class="card-footer bg-light d-flex justify-content-between align-items-center">
                    @php
    $from = request('from');
    $backRoute = $from === 'published'
        ? route('editor.berita.published')
        : ($from === 'draft' ? (Route::has('editor.berita.draft') ? route('editor.berita.draft') : route('editor.berita.index')) : route('editor.berita.index'));
@endphp
@php
    // Jika asal dari published, tombol kembali hanya ke /editor/berita/published
    if (request('from') === 'published') {
        $backRoute = route('editor.berita.published');
    } elseif (request('from') === 'draft' && Route::has('editor.berita.draft')) {
        $backRoute = route('editor.berita.draft');
    } else {
        $backRoute = route('editor.berita.index');
    }
@endphp
<a href="{{ $backRoute }}" class="btn btn-outline-primary">
    <i class="fas fa-arrow-left"></i> Kembali ke Daftar Berita Diterbitkan
</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
