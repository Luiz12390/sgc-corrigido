<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommunityJoinRequest extends Model
{
    protected $fillable = ['user_id', 'community_id', 'status'];
}
