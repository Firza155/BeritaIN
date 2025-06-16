@extends('layouts.app')

@section('title', 'Editor Dashboard')

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard Editor</h1>

</div>

<!-- Content Row -->
<div class="row">
    <!-- Total Berita Card -->
    <!-- Total Berita di Web Card -->
    <x-stat-card 
        title="Total Berita di Web" 
        :value="$totalBerita ?? 0" 
        icon="newspaper" 
        color="primary"
        :link="route('editor.berita.index')"
    />

    <!-- Berita Diterbitkan Card -->
    <x-stat-card 
        title="Berita Diterbitkan" 
        :value="$publishedBerita ?? 0" 
        icon="check-circle" 
        color="success"
        :link="route('editor.berita.index', ['status' => 'published'])"
    />

    <!-- Approval Berita Card -->
    <x-stat-card 
        title="Approval Berita" 
        :value="$approvalBerita ?? 0" 
        icon="tasks" 
        color="warning"
        :link="route('editor.approval.index')"
    />

    <!-- Draft Berita Card -->
    <x-stat-card 
        title="Draft Berita" 
        :value="$draftBerita ?? 0" 
        icon="file-alt" 
        color="info"
        :link="route('editor.berita.index', ['status' => 'draft'])"
    />
</div>

<!-- Tabel Berita Menunggu Approval -->
<div class="row mt-4">
    <div class="col-lg-12 mb-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between bg-warning-subtle">
                <h6 class="m-0 font-weight-bold text-warning">Berita Menunggu Approval</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Judul</th>
                                <th>Penulis</th>
                                <th>Kategori</th>
                                <th>Tanggal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($pendingBerita as $berita)
                            <tr>
                                <td>{{ $berita->judul ? Str::limit($berita->judul, 50) : '-' }}</td>
                                <td>{{ $berita->user->name ?? '-' }}</td>
                                <td>{{ $berita->kategori->nama ?? $berita->kategori->name ?? 'Tanpa Kategori' }}</td>
                                <td>{{ $berita->created_at ? $berita->created_at->format('d M Y') : '-' }}</td>
                                <td>
                                    <a href="{{ route('berita.show', $berita->id) }}" class="btn btn-sm btn-info" title="Lihat">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('approval.edit', $berita->id) }}" class="btn btn-sm btn-success" title="Review">
                                        <i class="fas fa-check"></i> Review
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center">Tidak ada berita yang menunggu approval</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
