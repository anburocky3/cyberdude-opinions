<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Course extends Model
{

    protected $guarded = [];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function getLastUpdatedOnAttribute()
    {
        return $this->sections()
            ->with('topics')
            ->get()
            ->flatMap->topics
            ->max('updated_at');
    }

    public function sections(): HasMany
    {
        return $this->hasMany(Section::class)->orderBy('order');
    }

    protected function casts(): array
    {
        return [
            'prerequisites' => 'json',
            'learning_objectives' => 'json',
            'is_membership' => 'boolean',
            'is_published' => 'boolean',
        ];
    }
}
