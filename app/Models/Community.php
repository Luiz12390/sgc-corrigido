<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Community extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'user_id',
        'cover_image_path',
    ];

    public function members(): BelongsToMany
    {
        return $this->belongsToMany(User::class)->withTimestamps()->withPivot('role');
    }

    public function joinRequests(): HasMany
    {
        return $this->hasMany(CommunityJoinRequest::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function posts() {
        return $this->hasMany(Post::class)->latest();
    }

    public function getLogoUrlAttribute()
    {
        if ($this->logo_path) {
            if (str_starts_with($this->logo_path, 'http')) {
                return $this->logo_path;
            }
            return asset('storage/' . $this->logo_path) . '?v=' . $this->updated_at?->timestamp;
        }

        return 'https://ui-avatars.com/api/?name=' . urlencode($this->name) . '&size=160&background=EBF4FF&color=7F9CF5';
    }
}
