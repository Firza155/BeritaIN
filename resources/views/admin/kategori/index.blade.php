@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-10">
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
                        <i class="fas fa-list fa-lg mr-2"></i>
                        <h5 class="m-0 font-weight-bold">Manajemen Kategori</h5>
                    </div>
                    <form class="form-inline my-2 my-lg-0" method="POST" action="{{ route('admin.kategori.store') }}">
    @csrf
    <input class="form-control form-control-sm mr-sm-2" type="text" placeholder="Nama kategori" name="name" required>
    <button class="btn btn-light btn-sm my-2 my-sm-0" type="submit"><i class="fas fa-plus"></i> Tambah</button>
</form>
<form class="form-inline my-2 my-lg-0 ml-md-2" method="GET" action="{{ route('admin.kategori.index') }}">
    <input class="form-control form-control-sm mr-sm-2" type="search" placeholder="Cari kategori..." aria-label="Search" name="q" value="{{ $q ?? '' }}">
    <button class="btn btn-outline-light btn-sm my-2 my-sm-0" type="submit"><i class="fas fa-search"></i></button>
</form>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover align-middle">
                            <thead class="thead-dark">
                                <tr>
                                    <th>No</th>
                                    <th>Nama Kategori</th>
                                    <th>Tanggal Dibuat</th>
<th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($categories as $item)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td><span class="badge badge-info"><i class="fas fa-tag"></i> {{ $item->name }}</span></td>
        <td>{{ $item->created_at ? $item->created_at->format('d M Y') : '-' }}</td>
        <td>
            <form action="{{ route('admin.kategori.destroy', $item->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Yakin ingin menghapus kategori ini?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm rounded-pill px-3">Hapus</button>
            </form>
        </td>
    </tr>
                                @empty
                                    <tr><td colspan="3" class="text-center text-muted">Belum ada kategori.</td></tr>
                                @endforelse
@if(isset($q) && $q)
<tr><td colspan="4" class="text-center text-muted">Menampilkan hasil pencarian untuk: <b>{{ $q }}</b></td></tr>
@endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
@endsection
