@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                    <i class="fas fa-check-circle"></i> {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <div class="card shadow mb-4 animate__animated animate__fadeIn">
                <div class="card-header py-3 d-flex flex-column flex-md-row justify-content-between align-items-center bg-gradient-primary text-white">
                    <div class="d-flex align-items-center mb-2 mb-md-0">
                        <i class="fas fa-clock fa-lg mr-2"></i>
                        <h5 class="m-0 font-weight-bold">Berita Approval Berita</h5>
                    </div>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover align-middle">
                            <thead class="thead-dark">
                                <tr>
                                    <th>No</th>
                                    <th>Judul</th>
                                    <th>Kategori</th>
                                    <th>Penulis</th>
                                    <th>Status</th>
                                    <th>Tanggal</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($pendingBerita as $berita)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td><b>{{ $berita->title }}</b></td>
                                        <td><span class="badge badge-info"><i class="fas fa-tag"></i> {{ $berita->category->name ?? '-' }}</span></td>
                                        <td><span class="badge badge-secondary"><i class="fas fa-user"></i> {{ $berita->user->name ?? '-' }}</span></td>
                                        <td><span class="badge badge-warning">Pending</span></td>
                                        <td>{{ $berita->created_at->format('d M Y') }}</td>
                                        <td>
                                            <form action="{{ route('admin.berita.approve', $berita->id) }}" method="POST" style="display:inline-block;">
    @csrf
    <button type="submit" class="btn btn-success btn-sm rounded-pill px-3">Setujui</button>
</form>
<form action="{{ route('admin.berita.reject', $berita->id) }}" method="POST" style="display:inline-block;">
    @csrf
    <button type="submit" class="btn btn-danger btn-sm rounded-pill px-3">Tolak</button>
</form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center text-muted">Tidak ada berita pending.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
