<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'description',
        'objectives',
        'start_date',
        'end_date',
        'status',
        'cover_image_path',
    ];

    public function members(): BelongsToMany
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }

    public function getCoverImageUrlAttribute()
    {
        if ($this->cover_image_path) {
            return asset('storage/' . $this->cover_image_path) . '?v=' . $this->updated_at->timestamp;
        }
        return 'https://images.unsplash.com/photo-1517048676732-d65bc937f952?w=800';
    }
}
