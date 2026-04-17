<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Automation extends Model
{
    protected $fillable = [
        'name',
        'description',
        'trigger_type',
        'active',
        'user_id'
    ];

    /**
     * Ejecuciones relacionadas con esta automatización.
     */
    public function executions(): HasMany
    {
        return $this->hasMany(Execution::class);
    }

    /**
     * Usuario propietario de la automatización.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
