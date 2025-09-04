<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; // 1. Adicione esta linha
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory; // 2. Adicione esta linha

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

}