<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Section extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title',
        'description',
        'order',
        'course_id',
    ];

    public function topics()
    {
        return $this->hasMany(Topic::class)->orderBy('order');
    }

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }
}
