<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enums\WorksheetPriority;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Worksheet extends Model
{
    protected $fillable = [
        'title',
        'device_id',
        'creator_id',
        'repairer_id',
        'status',
        'priority',
        'due_date',
        'finish_date',
        'attachments',
        'description',
    ];

    protected $casts = [
        'priority' => WorksheetPriority::class,
        'attachments' => 'array',
    ];

    public function device(): BelongsTo
    {
        return $this->belongsTo(Device::class);
    }
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'creator_id');
    }

    public function repairer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'repairer_id');
    }
    public function feedback()
    {
        return $this->hasOne(Feedback::class);
    }


}
