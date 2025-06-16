<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;
    protected $fillable = [
        'title', 'content', 'image', 'user_id', 'category_id', 'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Tambahan: relasi kategori (untuk kebutuhan blade berbahasa Indonesia)
    public function kategori()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
