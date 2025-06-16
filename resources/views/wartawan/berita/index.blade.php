@extends('layouts.app')

@section('title', 'Daftar Berita Saya')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h3">Daftar Berita Saya</h1>
    <a href="{{ route('news.create') }}" class="btn btn-primary">+ Tambah Berita</a>
</div>
<table class="table table-bordered table-striped table-hover">
    <thead class="thead-dark">
        <tr>
            <th>Judul</th>
            <th>Kategori</th>
            <th>Status</th>
            <th>Dibuat</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse($news as $item)
        <tr>
            <td>{{ $item->title }}</td>
            <td>{{ $item->category->name ?? '-' }}</td>
            <td>
                <span class="badge badge-{{ $item->status == 'approved' ? 'success' : ($item->status == 'pending' ? 'warning' : ($item->status == 'revisi' ? 'danger' : 'secondary')) }}">
                    {{ ucfirst($item->status) }}
                </span>
            </td>
            <td>{{ $item->created_at->format('d M Y') }}</td>
            <td>
                <a href="{{ route('news.edit', $item->id) }}" class="btn btn-sm btn-info">Edit</a>
                <form action="{{ route('news.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus berita?')">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger">Hapus</button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="5" class="text-center">Belum ada berita.</td>
        </tr>
        @endforelse
    </tbody>
</table>
@endsection

