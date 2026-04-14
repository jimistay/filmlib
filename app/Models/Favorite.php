<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WatchedMovie extends Model
{
    protected $fillable = [
        'user_id',
        'tmdb_id',
        'title',
        'poster_url',
        'rating',
        'watched_at',
    ];

    protected $casts = [
        'watched_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}