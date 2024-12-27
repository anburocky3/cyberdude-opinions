<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Suggestion extends Model
{
    // create status enum
    const STATUS = [
        'open' => 'Open',
        'considering' => 'Considering',
        'planned' => 'Planned',
        'in-progress' => 'In Progress',
        'completed' => 'Completed',
    ];
    
    protected $fillable = [
        'title',
        'technology',
        'tags',
        'desc',
        'user_id'
    ];

    protected $casts = [
        'tags' => 'array',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
