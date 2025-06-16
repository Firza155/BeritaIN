<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;
use App\Models\Kategori;

class Berita extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'kategori_id',
        'judul',
        'slug',
        'isi',
        'gambar',
        'status',
        'keterangan_ditolak',
        'published_at',
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }
}
