@extends('layouts.app')

@section('title', 'Buat Berita Baru')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow mb-4">
            <div class="card-header bg-primary text-white">Buat Berita Baru</div>
            <div class="card-body">
                <form action="{{ route('news.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="title">Judul</label>
                        <input type="text" name="title" id="title" class="form-control" required value="{{ old('title') }}">
                    </div>
                    <div class="form-group">
                        <label for="category_id">Kategori</label>
                        <select name="category_id" id="category_id" class="form-control" required>
                            <option value="">-- Pilih Kategori --</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="image">Gambar Berita (Opsional)</label>
                        <input type="file" class="form-control-file" id="image" name="image" accept="image/png, image/jpeg">
                        <small class="form-text text-muted">Upload gambar dengan format PNG atau JPG.</small>
                    </div>
                    <div class="form-group">
                        <label for="content">Isi Berita</label>
                        <textarea name="content" id="content" rows="7" class="form-control" required>{{ old('content') }}</textarea>
                    </div>
                    <button type="submit" name="action" value="draft" class="btn btn-primary">Simpan sebagai Draft</button>
                    <button type="submit" name="action" value="submit" class="btn btn-success">Kirim untuk Review</button>
                    <a href="{{ route('news.index') }}" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

