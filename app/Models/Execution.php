<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Execution extends Model
{
    protected $fillable = [
        'automation_id',
        'status',
        'attempt',
        'started_at',
        'finished_at',
    ];

    protected $casts = [
        'started_at'  => 'datetime',
        'finished_at' => 'datetime',
    ];

    /**
     * Duración de la ejecución en milisegundos.
     */
    public function getDurationMsAttribute(): ?int
    {
        if ($this->started_at && $this->finished_at) {
            return (int) $this->started_at->diffInMilliseconds($this->finished_at);
        }

        return null;
    }

    public function automation(): BelongsTo
    {
        return $this->belongsTo(Automation::class);
    }
}
