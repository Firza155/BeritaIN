@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-12">
            <div class="alert alert-warning d-flex align-items-center" role="alert">
                <i class="fas fa-user-pen fa-2x me-3"></i>
                <div>
                    <strong>Halo, {{ $user->name }}!</strong> Anda login sebagai <span class="badge bg-warning text-dark">Wartawan</span>.
                </div>
            </div>
        </div>
    </div>
    <div class="row g-4">
        <div class="col-md-4">
            <div class="card shadow h-100">
                <div class="card-body text-center">
                    <i class="fas fa-newspaper fa-2x text-primary mb-2"></i>
                    <h5 class="card-title">Berita Saya</h5>
                    <p class="card-text">Lihat dan edit berita yang Anda tulis sendiri.</p>
                    <a href="{{ route('wartawan.berita.saya') }}" class="btn btn-primary">Lihat Berita Saya</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow h-100">
                <div class="card-body text-center">
                    <i class="fas fa-pen-nib fa-2x text-success mb-2"></i>
                    <h5 class="card-title">Tulis Berita</h5>
                    <p class="card-text">Buat berita baru untuk diproses lebih lanjut.</p>
                    <a href="{{ route('news.create') }}" class="btn btn-success">Tulis Berita</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
