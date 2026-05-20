<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class CmsPage extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'nav_label',
        'route_name',
        'content',
        'is_system',
        'is_published',
        'in_navigation',
        'navigation_order',
    ];

    protected $casts = [
        'is_system' => 'boolean',
        'is_published' => 'boolean',
        'in_navigation' => 'boolean',
    ];

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('is_published', true);
    }

    public function scopeNavigation(Builder $query): Builder
    {
        return $query->published()->where('in_navigation', true)->orderBy('navigation_order')->orderBy('title');
    }
}
