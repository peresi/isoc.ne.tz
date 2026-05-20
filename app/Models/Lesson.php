<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    protected $fillable = [
        'course_id',
        'title',
        'slug',
        'content',
        'video_url',
        'duration_minutes',
        'position',
    ];

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }
}
