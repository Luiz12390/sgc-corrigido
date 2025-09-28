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
        if ($this->cover_image_path) {
            if (str_starts_with($this->cover_image_path, 'http')) {
                return $this->cover_image_path;
            }
            return asset('storage/' . $this->cover_image_path) . '?v=' . $this->updated_at?->timestamp;
        }

        return 'https://images.unsplash.com/photo-1517048676732-d65bc937f952?w=800&auto=format&fit=crop';
    }

    public function getFileUrlAttribute()
    {
        if ($this->file_path) {
            return asset('storage/' . $this->file_path);
        }
        return null;
    }

    public function recordActivity($type)
    {
        $this->activities()->create([
            'user_id' => $this->user_id,
            'type' => $type,
        ]);
    }

    public function activities()
    {
        return $this->morphMany(\App\Models\Activity::class, 'subject');
    }
}
