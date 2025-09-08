<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Organization extends Model
{
    use HasFactory; // 2. Adicione esta linha

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'owner_id',
        'logo_path',
        'type',
        'specialization_areas',
        'competencies',
        'available_resources'
    ];

    public function members(): BelongsToMany
    {
        return $this->belongsToMany(User::class)
                    ->withPivot('role', 'status')
                    ->withTimestamps();
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function joinRequests() {
        return $this->hasMany(JoinRequest::class);
    }

    public function getLogoUrlAttribute()
    {
        if ($this->logo_path) {
            return asset('storage/' . $this->logo_path) . '?v=' . $this->updated_at->timestamp;
        }
        return 'https://ui-avatars.com/api/?name=' . urlencode($this->name) . '&size=160&background=EBF4FF&color=7F9CF5';
    }

    public function projects(): HasMany
    {
        return $this->hasMany(Project::class);
    }
}
