@extends('layouts.app')

@section('title', 'Daftar Draft Berita')

@section('content')
<div class="container-fluid px-4 py-4">
    <div class="card shadow mb-4">
        <div class="card-header py-3 bg-info d-flex align-items-center">
            <i class="fas fa-file-alt fa-lg text-white mr-2"></i>
            <h4 class="m-0 font-weight-bold text-white">Daftar Draft Berita</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-striped align-middle rounded shadow-sm overflow-hidden">
                    <thead class="thead-dark sticky-top">
                        <tr>
                            <th class="bg-info text-white">Judul</th>
                            <th class="bg-info text-white">Penulis</th>
                            <th class="bg-info text-white">Kategori</th>
                            <th class="bg-info text-white">Tanggal Draft</th>
                            <th class="bg-info text-white">Status</th>
                            <th class="bg-info text-white text-center">Detail</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($draftBerita as $berita)
                        <tr class="align-middle">
                            <td class="fw-semibold">{{ $berita->title }}</td>
                            <td>{{ $berita->user->name ?? '-' }}</td>
                            <td>{{ $berita->kategori->nama ?? 'Tanpa Kategori' }}</td>
                            <td><i class="fas fa-calendar-alt text-secondary mr-1"></i> {{ $berita->created_at ? $berita->created_at->format('d M Y H:i') : '-' }}</td>
                            <td>
                                <span class="badge badge-pill badge-info px-3 py-2" style="font-size:0.95em;">Draft</span>
                            </td>
                            <td class="text-center">
                                <a href="{{ route('editor.berita.show', [$berita->id, 'from' => 'draft']) }}" class="btn btn-sm btn-outline-info rounded-circle" data-toggle="tooltip" data-placement="top" title="Lihat Detail">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center">Tidak ada draft berita</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-center mt-3">
                {{ $draftBerita->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
