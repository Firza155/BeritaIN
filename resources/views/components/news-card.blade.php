@props(['berita', 'role'])

<div class="col-md-6 col-lg-4 mb-4">
    <div class="card h-100 shadow-sm">
        @if($berita->gambar)
        <img src="{{ asset('storage/' . $berita->gambar) }}" class="card-img-top" alt="{{ $berita->judul }}" style="height: 200px; object-fit: cover;">
        @else
        <div class="bg-light d-flex align-items-center justify-content-center" style="height: 200px;">
            <i class="fas fa-image fa-3x text-muted"></i>
        </div>
        @endif
        
        <div class="card-body d-flex flex-column">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <span class="badge bg-primary">{{ $berita->kategori->nama ?? 'Tanpa Kategori' }}</span>
                <small class="text-muted">{{ $berita->created_at->diffForHumans() }}</small>
            </div>
            
            <h5 class="card-title">{{ Str::limit($berita->judul, 50) }}</h5>
            <p class="card-text flex-grow-1">{{ Str::limit(strip_tags($berita->isi), 100) }}</p>
            
            <div class="d-flex justify-content-between align-items-center mt-3">
                <small class="text-muted">
                    <i class="fas fa-user-edit me-1"></i> {{ $berita->user->name }}
                </small>
                <div class="btn-group">
                    @if($role === 'admin' || $role === 'editor')
                        <a href="{{ route('berita.edit', $berita->id) }}" class="btn btn-sm btn-outline-primary">
                            <i class="fas fa-edit"></i>
                        </a>
                    @endif
                    
                    @if($role === 'admin')
                        <form action="{{ route('berita.destroy', $berita->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger" 
                                    onclick="return confirm('Apakah Anda yakin ingin menghapus berita ini?')">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    @endif
                    
                    @if($role === 'editor' && $berita->status === 'draft')
                        <form action="{{ route('berita.approve', $berita->id) }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-outline-success">
                                <i class="fas fa-check"></i> Setujui
                            </button>
                        </form>
                    @endif
                </div>
            </div>
            
            @if($role === 'wartawan' && $berita->user_id === auth()->id())
            <div class="mt-2">
                <span class="badge {{ $berita->status === 'draft' ? 'bg-warning' : 'bg-success' }}">
                    {{ ucfirst($berita->status) }}
                </span>
            </div>
            @endif
        </div>
    </div>
</div>
