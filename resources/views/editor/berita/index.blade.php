@extends('layouts.app')

@section('title', 'Daftar Berita')

@section('content')
<div class="container-fluid px-4 py-4">
    <div class="card shadow mb-4">
        <div class="card-header py-3 bg-primary">
            <h4 class="m-0 font-weight-bold text-white">Daftar Berita</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th>Judul</th>
                            <th>Penulis</th>
                            <th>Kategori</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($daftarBerita as $berita)
                        <tr>
                            <td>{{ $berita->title ? Str::limit($berita->title, 50) : '-' }}</td>
                            <td>{{ $berita->user->name ?? '-' }}</td>
                            <td>{{ $berita->kategori->nama ?? $berita->kategori->name ?? 'Tanpa Kategori' }}</td>
                            <td>{{ $berita->created_at ? $berita->created_at->format('d M Y H:i') : '-' }}</td>
                            <td>
                                <span class="badge badge-{{ $berita->status == 'published' ? 'success' : ($berita->status == 'pending' ? 'warning' : 'secondary') }}">
                                    {{ ucfirst($berita->status) }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('editor.berita.show', $berita->id) }}" class="btn btn-sm btn-info" title="Lihat Detail">
                                    <i class="fas fa-eye"></i> Detail
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center">Tidak ada berita ditemukan</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-center mt-3">
                {{ $daftarBerita->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
