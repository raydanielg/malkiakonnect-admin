<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AdminTask extends Model
{
    protected $fillable = [
        'title',
        'status',
        'assigned_to',
        'due_at',
    ];

    protected $casts = [
        'due_at' => 'datetime',
    ];

    public function assignee(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }
}
