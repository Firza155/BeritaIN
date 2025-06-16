@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-12">
            <div class="alert alert-primary d-flex align-items-center" role="alert">
                <i class="fas fa-user-shield fa-2x me-3"></i>
                <div>
                    <strong>Halo, {{ $user->name }}!</strong> Anda login sebagai <span class="badge bg-primary">Admin</span>.
                </div>
            </div>
        </div>
    </div>
    <div class="row g-4">
        <div class="col-md-4">
            <div class="card shadow h-100">
                <div class="card-body text-center">
                    <i class="fas fa-newspaper fa-2x text-primary mb-2"></i>
                    <h5 class="card-title">Kelola Berita</h5>
                    <p class="card-text">Lihat, tambah, edit, dan hapus semua berita.</p>
                    <a href="{{ route('news.create') }}" class="btn btn-success">Tambah Berita</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow h-100">
                <div class="card-body text-center">
                    <i class="fas fa-user-cog fa-2x text-success mb-2"></i>
                    <h5 class="card-title">Kelola User</h5>
                    <p class="card-text">Lihat, tambah, edit, dan hapus user.</p>
                    <a href="{{ route('admin.user.index') }}" class="btn btn-success">Kelola User</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow h-100">
                <div class="card-body text-center">
                    <i class="fas fa-list-alt fa-2x text-warning mb-2"></i>
                    <h5 class="card-title">Kelola Kategori</h5>
                    <p class="card-text">Kelola kategori berita.</p>
                    <a href="{{ route('admin.kategori.index') }}" class="btn btn-warning text-white">Kelola Kategori</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow h-100 mt-4">
                <div class="card-body text-center">
                    <i class="fas fa-check-circle fa-2x text-info mb-2"></i>
                    <h5 class="card-title">Approval Berita</h5>
                    <p class="card-text">Setujui atau tolak berita sebelum dipublish.</p>
                    <a href="{{ route('admin.approval.index') }}" class="btn btn-info text-white">Approval Berita</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow h-100 mt-4">
                <div class="card-body text-center">
                    <i class="fas fa-toggle-on fa-2x text-secondary mb-2"></i>
                    <h5 class="card-title">Ubah Status Berita</h5>
                    <p class="card-text">Aktifkan/nonaktifkan status berita.</p>
                    <a href="{{ route('admin.status.index') }}" class="btn btn-secondary">Ubah Status</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow h-100 mt-4">
                <div class="card-body text-center">
                    <i class="fas fa-users-cog fa-2x text-danger mb-2"></i>
                    <h5 class="card-title">Ubah Role User</h5>
                    <p class="card-text">Ubah peran user (Admin, Editor, Wartawan).</p>
                    <a href="{{ route('admin.role.index') }}" class="btn btn-danger">Ubah Role</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
