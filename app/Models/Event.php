<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $casts = [
        'start_date' => 'datetime',
    ];

    public function getCoverImageUrlAttribute()
    {
        if ($this->cover_image_path) {
            if (str_starts_with($this->cover_image_path, 'http')) {
                return $this->cover_image_path;
            }
            return asset('storage/' . $this->cover_image_path);
        }
        return 'https://images.unsplash.com/photo-1517048676732-d65bc937f952?w=800';
    }
}
