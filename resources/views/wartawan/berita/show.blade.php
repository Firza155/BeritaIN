@extends('layouts.app')

@section('title', 'Detail Berita')

@section('content')
<div class="row">
    <div class="col-lg-10 mx-auto">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Detail Berita</h6>
                <a href="{{ url()->previous() }}" class="btn btn-secondary btn-sm">Kembali</a>
            </div>
            <div class="card-body">
                <h1 class="h3 mb-3">{{ $news->title }}</h1>
                @if($news->image)
                <div class="mb-3">
                    <img src="{{ asset('storage/' . $news->image) }}" class="img-fluid rounded" alt="{{ $news->title }}">
                </div>
                @endif

                <div class="d-flex align-items-center mb-3 text-muted">
                    <span class="mr-3"><i class="fas fa-user-edit mr-1"></i> {{ $news->user->name }}</span>
                    <span class="mr-3"><i class="fas fa-folder-open mr-1"></i> {{ $news->category->name }}</span>
                    <span><i class="fas fa-calendar-alt mr-1"></i> {{ $news->created_at->format('d F Y, H:i') }}</span>
                </div>
                <hr>
                <div class="news-content">
                    {!! nl2br(e($news->content)) !!}
                </div>
            </div>
            <div class="card-footer text-right">
                 <a href="{{ route('news.edit', $news->id) }}" class="btn btn-primary">Edit Berita</a>
            </div>
        </div>
    </div>
</div>
@endsection
