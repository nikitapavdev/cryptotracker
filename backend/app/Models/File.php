<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class File extends Model
{
    // Owner of the file
    public function user(): BelognsTo
    {
        return $this->belongsTo(User::class);
    }
    
}
