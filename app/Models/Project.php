<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Project extends Model
{
    use HasFactory, Searchable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'description',
        'user_id',
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
            if (str_starts_with($this->cover_image_path, 'http')) {
                return $this->cover_image_path;
            }
            return asset('storage/' . $this->cover_image_path) . '?v=' . $this->updated_at?->timestamp;
        }

        return 'https://images.unsplash.com/photo-1517048676732-d65bc937f952?w=800&auto=format&fit=crop';
    }

    public function joinRequests()
    {
        return $this->hasMany(ProjectJoinRequest::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function toSearchableArray(): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
        ];
    }

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }
}
