<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'community_id', 'content'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function community()
    {
        return $this->belongsTo(Community::class);
    }

    public function comments() {
        return $this->hasMany(Comment::class)->orderBy('created_at', 'asc');
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

    public function attachments()
    {
        return $this->hasMany(PostAttachment::class);
    }
}
