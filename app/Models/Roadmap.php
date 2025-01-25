<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Roadmap extends Model
{
    use SoftDeletes;

    const STATUS = [
        'suggestions' => 'Suggestions',
        'planned' => 'Planned',
        'in-development' => 'In Development',
        'ready-to-watch' => 'Ready to Watch',
    ];
    protected $fillable = [
        'title',
        'description',
        'tags',
        'status',
    ];

    protected $casts = [
        'tags' => 'array',
    ];
}
