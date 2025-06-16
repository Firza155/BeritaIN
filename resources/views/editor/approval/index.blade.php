@extends('layouts.app')

@section('title', 'Daftar Approval Berita')

@section('content')
<div class="container-fluid px-4 py-4">
    <div class="card shadow mb-4">
        <div class="card-header py-3 bg-warning">
            <h4 class="m-0 font-weight-bold text-dark">Daftar Approval Berita</h4>
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
                        @forelse($pendingBerita ?? [] as $berita)
                        <tr>
                            <td>{{ Str::limit($berita->judul, 50) }}</td>
                            <td>{{ $berita->user->name ?? '-' }}</td>
                            <td>{{ $berita->kategori->nama ?? 'Tanpa Kategori' }}</td>
                            <td>{{ $berita->created_at ? $berita->created_at->format('d M Y H:i') : '-' }}</td>
                            <td>
                                <span class="badge badge-{{ $berita->status == 'pending' ? 'warning' : ($berita->status == 'published' ? 'success' : 'secondary') }}">
                                    {{ ucfirst($berita->status) }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('editor.approval.edit', $berita->id) }}" class="btn btn-sm btn-success" title="Review">
                                    <i class="fas fa-check"></i> Review
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center">Tidak ada berita yang membutuhkan approval</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if(isset($pendingBerita))
            <div class="d-flex justify-content-center mt-3">
                {{ $pendingBerita->links() }}
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
