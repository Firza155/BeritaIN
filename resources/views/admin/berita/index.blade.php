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
                            <i class="fas fa-newspaper fa-lg mr-2"></i>
                            <h5 class="m-0 font-weight-bold">Daftar Berita</h5>
                        </div>
                        <form class="form-inline my-2 my-lg-0" method="GET" action="">
                            <input class="form-control form-control-sm mr-sm-2" type="search" placeholder="Cari berita..." aria-label="Search" name="q">
                            <button class="btn btn-outline-light btn-sm my-2 my-sm-0" type="submit"><i class="fas fa-search"></i></button>
                        </form>
                        <a href="#" class="btn btn-light btn-sm ml-md-2"><i class="fas fa-plus"></i> Tambah Berita</a>
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
                                    @forelse($berita as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td><b>{{ $item->title }}</b></td>
                                            <td><span class="badge badge-info"><i class="fas fa-tag"></i> {{ $item->category->name ?? '-' }}</span></td>
                                            <td><span class="badge badge-secondary"><i class="fas fa-user"></i> {{ $item->user->name ?? '-' }}</span></td>
                                            <td>
                                                @if($item->status == 'published')
                                                    <span class="badge badge-success"><i class="fas fa-check-circle"></i> Published</span>
                                                @elseif($item->status == 'pending')
                                                    <span class="badge badge-warning"><i class="fas fa-clock"></i> Pending</span>
                                                @else
                                                    <span class="badge badge-danger"><i class="fas fa-times-circle"></i> Rejected</span>
                                                @endif
                                            </td>
                                            <td>{{ $item->created_at->format('d M Y') }}</td>
                                            <td>
                                                <form action="{{ route('admin.berita.destroy', $item->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Yakin ingin menghapus berita ini?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm rounded-pill px-3">Hapus</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr><td colspan="7" class="text-center text-muted">Belum ada berita.</td></tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Animasi CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
@endsection
