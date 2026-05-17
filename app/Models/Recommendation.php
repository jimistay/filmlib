<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Recommendation extends Model
{
    protected $fillable = [
    'user_id',
    'tmdb_id',
    'media_type',
    'title',
    'poster_url',
    'watch_providers',
    'watch_link',
    'reason',
    'generated_at',
];

protected $casts = [
    'generated_at' => 'datetime',
    'watch_providers' => 'array',
];
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}