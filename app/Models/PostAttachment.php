<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class PostAttachment extends Model
{
    use HasFactory;

    protected $fillable = ['post_id', 'file_path', 'file_name'];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function getIconAttribute(): string
    {
        $extension = Str::lower(pathinfo($this->file_name, PATHINFO_EXTENSION));

        return match ($extension) {
            'pdf' => '<svg ...> </svg>',
            'doc', 'docx' => '<svg ...> </svg>',
            'xls', 'xlsx' => '<svg ...> </svg>',
            'jpg', 'jpeg', 'png', 'gif' => '<svg ...> </svg>',
            default => '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" /></svg>', // Ícone padrão
        };
    }

    public function isImage(): bool
    {
        $imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp', 'svg'];
        $extension = Str::lower(pathinfo($this->file_name, PATHINFO_EXTENSION));
        return in_array($extension, $imageExtensions);
    }
}
