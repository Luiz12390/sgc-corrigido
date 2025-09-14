<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Resource extends Model
{
    use HasFactory, Searchable;

    protected $fillable = [
        'user_id', 'title', 'description', 'type', 'file_path', 'cover_image_path',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getCoverImageUrlAttribute()
    {
        // ... (Lógica do accessor de imagem que já temos) ...
    }

    // Novo Accessor para o link do ficheiro
    public function getFileUrlAttribute()
    {
        if ($this->file_path) {
            return asset('storage/' . $this->file_path);
        }
        return null;
    }
}
