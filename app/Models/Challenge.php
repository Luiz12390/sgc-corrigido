<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Challenge extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'type',
        'description',
        'cover_image_path',
    ];

     /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'id';
    }

    /**
     * Get the URL for the challenge's cover image.
     *
     * @return string
     */
    public function getCoverImageUrlAttribute()
    {
        if ($this->cover_image_path) {
            if (str_starts_with($this->cover_image_path, 'http')) {
                return $this->cover_image_path;
            }
            return asset('storage/' . $this->cover_image_path) . '?v=' . $this->updated_at?->timestamp;
        }

        return 'https://images.unsplash.com/photo-1556742502-ec7c0e9f34b1?w=800&auto=format&fit=crop';
    }
}
