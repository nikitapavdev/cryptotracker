<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class File extends Model
{
    use HasFactory;

    protected $fillable = [
        'original_name',
        'custom_name', 
        's3_key',
        'mime_type',
        'size',
        'user_id',
        'is_public'
    ];

    // Owner of the file
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    
}
