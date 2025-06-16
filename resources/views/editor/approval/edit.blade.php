@extends('layouts.app')

@section('title', 'Review & Approval Berita')

@section('content')
<div class="container-fluid px-4 py-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3 bg-warning d-flex flex-column flex-md-row align-items-md-center justify-content-between">
                    <h4 class="m-0 font-weight-bold text-dark">Review & Approval: {{ $berita->judul ?? '-' }}</h4>
                    <span class="badge badge-{{ $berita->status == 'pending' ? 'warning' : ($berita->status == 'published' ? 'success' : 'secondary') }} ml-md-3">
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

                    <hr>
                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-center">
                        <!-- Approve Form -->
                        <form action="{{ route('editor.approval.approve', $berita->id) }}" method="POST" class="mb-2 mb-md-0">
                            @csrf
                            <button type="submit" class="btn btn-success btn-lg">
                                <i class="fas fa-check"></i> Approve
                            </button>
                        </form>
                        <!-- Reject Button triggers modal -->
                        <button type="button" class="btn btn-danger btn-lg ml-md-2" data-toggle="modal" data-target="#modalTolak">
                            <i class="fas fa-times"></i> Reject
                        </button>
                    </div>
                </div>
                <div class="card-footer bg-light d-flex justify-content-between align-items-center">
                    <a href="{{ route('editor.approval.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali ke Daftar Approval
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Tolak -->
    <div class="modal fade" id="modalTolak" tabindex="-1" role="dialog" aria-labelledby="modalTolakLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('editor.approval.reject', $berita->id) }}" method="POST">
                    @csrf
                    <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title" id="modalTolakLabel">Tolak Berita</h5>
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="alasan">Alasan Penolakan</label>
                            <textarea name="alasan" id="alasan" rows="3" class="form-control" required placeholder="Masukkan alasan penolakan..."></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger">Kirim Penolakan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
